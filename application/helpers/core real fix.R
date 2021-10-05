#import semua library
library(tm)
library(NLP)
library(stringr)
library(katadasaR)
library(RTextTools)
library(RMySQL)

#untuk koneksi mysql
con <- dbConnect(MySQL(),
                 user="root", password="",
                 dbname="criminal", host="localhost")

#load data berita
query <- "select * from berita where idstatus=0"
berita <- dbSendQuery(con, query)
berita <- fetch(berita)

#load daftar bulan
query <- "select * from bulan"
namabulan <- dbSendQuery(con, query)
namabulan <- fetch(namabulan)

#load daftar bulan
query <- "select * from hari"
namahari <- dbSendQuery(con, query)
namahari <- fetch(namahari)

#load daftar kota
query <- "select * from tbl_kodepos"
kota <- dbSendQuery(con, query)
kota <- fetch(kota)

#load daftar kota
query <- "select * from kejahatan"
daftarkejahatan <- dbSendQuery(con, query)
daftarkejahatan <- fetch(daftarkejahatan)

#load daftar nama
daftarnama <- read.csv("F:\\tugas\\skripsi\\Crime News\\daftarnama.csv", header=F, stringsAsFactors = F)

#load klasifikasi
klasifikasi <- read.csv("F:\\tugas\\skripsi\\Crime News\\klasifikasi.csv",header = FALSE, sep = ",", stringsAsFactors = FALSE)

#bikin bikin function pemecah kata
string_bersih <- function(string){
  temp <- stringr::str_replace_all(string,"[\\s]+", " ")
  temp <- stringr::str_split(temp," ")[[1]]
  indexes <- which(temp == "")
  if(length(indexes) > 0){
    temp <- temp[-indexes]
  }
  return(temp)
}
copyberita <- berita$ISIBERITA
copyberita <- cbind(copyberita,'','','','','','','','')

#sequence
for(index in min(berita$IDBERITA):length(berita$ISIBERITA)){
  pecahberita <- string_bersih(berita$ISIBERITA[index])
  
  if(length(pecahberita) != 0){
    #cari posisi nama hari
    posisi <- NULL
    posisi <- match(tolower(pecahberita), tolower(namahari$NAMAHARI))
    
    #ambil indeks hari
    indexhari <- NULL
    counter <- 1
    for(i in 1:length(pecahberita)){
      if(!is.na(posisi[i]) == TRUE){
        indexhari[counter] <- i
        counter <- counter +1
      }
    }
    
    if(is.null(indexhari)==FALSE){
      #masukkan nama hari
      tampungtanggal <- NULL
      
      copyberita[index,2] <- namahari$IDHARI[posisi[indexhari[1]]]
      
      #mencari posisi tanggal
      tampungtanggal <- str_match(pecahberita[indexhari[1]+1],"(\\d+)/(\\d+)")
      if(is.na(tampungtanggal[1])==FALSE){
        tampungtanggal <- tampungtanggal[,-1]
        tampungtanggal <- as.integer(tampungtanggal)
        tampungtanggal[2] <- namabulan$IDBULAN[tampungtanggal[2]]
      
        copyberita[index,3] <- tampungtanggal[1]
        copyberita[index,4] <- tampungtanggal[2]
      } else {
        copyberita[index,3] <- 0
        copyberita[index,4] <- namabulan$IDBULAN[1]
      }
    } else {
      copyberita[index,2] <- namahari$IDHARI[1]
      copyberita[index,3] <- 0
      copyberita[index,4] <- namabulan$IDBULAN[1]
    }
    
    #mencari kota
    tampungkota <- NULL
    tampungkota <- which(pecahberita == "Memo")
    tampungkota <- as.integer(tampungkota)
    
    if(length(tampungkota != 0)){
      x <- tampungkota[1]
      #ambil string yang posisinya persis sebelum memo
      tampungkota <- pecahberita[x-1]
      #nghapus koma yang ada di kotanya
      tampungkota <- str_match(tampungkota,"\\w+")
      
      
      if(!is.na(match(tolower(tampungkota), tolower(kota$KABUPATEN)))==TRUE){
        tampungkota <- match(tolower(tampungkota), tolower(kota$KABUPATEN))
        tampungkota <- kota$IDKELURAHAN[tampungkota]
        copyberita[index,5] <- tampungkota
      } else {
        tampungkota <- pecahberita[x-1]
        q <- unlist(gregexpr("[A-Z]",tampungkota))
        w <-length(q)
        tampungkota <- substr(tampungkota, q[w], (nchar(tampungkota)))
        tampungkota <- str_match(tampungkota,"\\w+")
        if(!is.na(match(tolower(tampungkota), tolower(kota$KABUPATEN)))==TRUE){
          tampungkota <- match(tolower(tampungkota), tolower(kota$KABUPATEN))
          tampungkota <- kota$IDKELURAHAN[tampungkota]
          copyberita[index,5] <- tampungkota
        } else {
          copyberita[index,5] <- kota$IDKELURAHAN[476]
        }
      }
    } else {
      copyberita[index,5] <- kota$IDKELURAHAN[476]
    }
    
    #mencari klasifikasi
    posisi <- NULL
    posisi <- match(tolower(pecahberita), tolower(klasifikasi$V1))
    tampung <- NA
    
    for(i in 1:length(pecahberita)){
      if(!is.na(posisi[i]) == TRUE){
        #nampung array nomer berapa yang ada kejahatannya
        tampung <- i
      }
    }

    if(is.na(tampung) == FALSE){
      tampung <- match(tolower(klasifikasi$V2[posisi[tampung]]),tolower(daftarkejahatan$JENISKEJAHATAN))
      copyberita[index,6] <- daftarkejahatan$IDJENIS[tampung]
    } else {
      copyberita[index,6] <- daftarkejahatan$IDJENIS[1]
    }
    
    #memasukkan detil berita yang sudah didapatkan ke dalam tabel
    query <- sprintf("insert into detailberita values('','%s','%s',%d,%s,'%s',%s)", copyberita[index,6], copyberita[index,4], index, copyberita[index,5], copyberita[index,2], copyberita[index,3])
    sql <- dbSendQuery(con, query)
    
    #cari nama pelaku
    cariumur <- NULL
    cariumur <- regmatches(berita$ISIBERITA[index], gregexpr("(?=\\().*?(?<=\\))", berita$ISIBERITA[index], perl = T))[[1]]
    cariindex <- NULL
    umur <- NULL
    tukangitung <- 1
    if(length(cariumur) != 0){
      for(carinama in 1:length(cariumur)){
        if(nchar(cariumur[carinama]) == 4){
          if(grepl("\\d+", cariumur[carinama]) == TRUE){
            angkaindex <- grepl(cariumur[carinama], pecahberita)
            angkaindex <- which(angkaindex == TRUE)
            counter <- length(angkaindex)
            for(i in 1:counter){
              cariindex[tukangitung] <- pecahberita[angkaindex[i]-1]
              tampungumur <- str_match(pecahberita[angkaindex[i]],"\\d+")
              tampungumur <- as.integer(tampungumur)
              umur[tukangitung] <- tampungumur
              tukangitung <- tukangitung +1
            }
          }
        }
      }
    }
    
    cariindex <- cariindex[!duplicated(cariindex)]
    xxxx <- grepl("^[[:upper:]]", cariindex)
    xxxx <- which(xxxx == TRUE)
    cariindex <- cariindex[xxxx]
    
    qwe <- 1
    if(is.null(carinama) == FALSE){
      for(qwe in 1:length(cariindex)){
        query <- NULL
        index <- as.integer(index)
        umur[qwe] <- as.integer(umur[qwe])
        if (length(umur) != 0){
          if (nchar(umur[qwe]) < 3) {
            query <- sprintf("INSERT INTO keterlibatan VALUES ('',%d,'%s',%d,'N/A')",index,cariindex[qwe],umur[qwe])
            if(length(query) != 0){
              sql <- dbSendQuery(con, query)
            }
          }
        }
      }
    }
    
    #cari jenis kelamin
    uio <- NA
    if(length(cariindex) !=0){
      kelamin <- NULL
      hitung <- 1
      for(counter in 1:length(cariindex)){
        if(length(which(cariindex[counter] == daftarnama$V1)) != 0){
          tampungkelamin <- which(cariindex[counter] == daftarnama$V1)
          tampungkelamin <- daftarnama$V2[tampungkelamin]
          kelamin[hitung] <- tampungkelamin
          
          query <- NULL
          
          query <- sprintf("UPDATE keterlibatan SET jeniskelamin = '%s' WHERE namaorang = '%s' AND iddetail=%d", kelamin[hitung], cariindex[counter], index)
          sql <- dbSendQuery(con,query)
          
          hitung <- hitung+1
        }
      }
    }

  } else {
    copyberita[index,2] <- namahari$IDHARI[1]
    copyberita[index,3] <- 0
    copyberita[index,4] <- namabulan$IDBULAN[1]
    copyberita[index,5] <- kota$IDKELURAHAN[476]
    copyberita[index,6] <- daftarkejahatan$IDJENIS[1]
    
    #memasukkan detil berita yang sudah didapat 
    query <- sprintf("insert into detailberita values('','%s','%s',%d,%s,'%s',%s)", copyberita[index,6], copyberita[index,4], index, copyberita[index,5], copyberita[index,2], copyberita[index,3])
    sql <- dbSendQuery(con, query)
  }

  #update status berita 
  query <- sprintf("UPDATE berita SET idstatus=1 where idberita=%d",index)
  sql <- dbSendQuery(con, query)
}
