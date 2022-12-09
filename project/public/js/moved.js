var KichThuoc = document.getElementsByClassName("sidle_img")[0].clientWidth;
var ChuyenSlide = document.getElementsByClassName("sidle_img_moved_slide")[0];
var Chuyen = 0;
var Img = ChuyenSlide.getElementsByTagName("img");
var Max = KichThuoc * Img.length;
Max -= KichThuoc;
function Next(){
    if(Chuyen<Max)Chuyen +=  KichThuoc;
    else Chuyen = 0;
    ChuyenSlide.style.marginLeft = '-'+Chuyen+'px'; 
}
function Back(){
   if(Chuyen == 0) Chuyen = Max;
   else Chuyen -= KichThuoc;
    ChuyenSlide.style.marginLeft ='-' + Chuyen + 'px';
}
setInterval (function(){
    Next();
},3000)