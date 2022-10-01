$(document).ready(function(){
    $("#btn-keranjang").click(function(){
        $("#navbarSupportedContent").collapse('hide');
    });
  });

  // $(function () {
  //   $('[data-toggle="tooltip"]').tooltip()
    
  // });

  
var dropdown = document.getElementsByClassName("model-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
  this.classList.toggle("active");
  var dropdownContent = this.nextElementSibling;
  if (dropdownContent.style.display === "none") {
  dropdownContent.style.display = "block";
  } else {
  dropdownContent.style.display = "none";
  }
  });
}

$('#model-btn').click(function(){
  $('#model-show').toggleClass("show");
  $('.model-rotate').toggleClass("rotate");
});

$('#harga-btn').click(function(){
  $('#harga-show').toggleClass("show");
  $('.harga-rotate').toggleClass("rotate");
});

$('#model-btn-mob').click(function(){
  $('#model-show-mob').toggleClass("show");
  $('.model-rotate').toggleClass("rotate");
});



// FILTER HARGA WEB------------------

window.onload = function(){
  slideOne();
  slideTwo();
  slideOnem();
  slideTwom();
}

let sliderOne=document.getElementById("slider-1");
let sliderTwo=document.getElementById("slider-2");
let displaValOne=document.getElementById("range1");
let displaValTwo=document.getElementById("range2");
let minGap=10000;
let sliderTrack = document.querySelector(".slider-track");
let sliderMaxValue = document.getElementById("slider-1").max;


function slideOne(){
  if(parseInt(sliderTwo.value) -parseInt
  (sliderOne.value) <= minGap){
    sliderOne.value=parseInt(sliderTwo.value)
    -minGap;
  }
  nilai1 =sliderOne.value;
  // desimal1 = nilai1.toLocaleString(undefined, {maximumFractionDigits:2})

  function rubah(angka){
    var reverse = angka.toString().split('').reverse().join(''),
    ribuan = reverse.match(/\d{1,3}/g);
    ribuan = ribuan.join('.').split('').reverse().join('');
    return ribuan;
  }

  displaValOne.textContent=rubah(nilai1);


  fillcolor();
}
function slideTwo(){
  if(parseInt(sliderTwo.value) -parseInt
  (sliderOne.value) <= minGap){
    sliderTwo.value=parseInt(sliderOne.value)
    + minGap;
  }
  nilai2 =sliderTwo.value;
  function rubah(angka){
    var reverse = angka.toString().split('').reverse().join(''),
    ribuan = reverse.match(/\d{1,3}/g);
    ribuan = ribuan.join('.').split('').reverse().join('');
    return ribuan;
  }
  displaValTwo.textContent=rubah(nilai2);
  fillcolor();
}

function fillcolor(){
  percent1 = (sliderOne.value / sliderMaxValue) * 100;
  percent2 = (sliderTwo.value / sliderMaxValue) * 100;
  sliderTrack.style.background = `linear-gradient(to right, #dadae5  ${percent1}% , #99999e ${percent1}% , #99999e ${percent2}% , #dadae5  ${percent2}%)`;
  console.log(sliderTrack.style.background);
}
// -------------------------------FILTER HARGA WEB

// FILTER HARGA MOBILE----------------------------


let sliderOnem=document.getElementById("slider-1m");
let sliderTwom=document.getElementById("slider-2m");
let displaValOnem=document.getElementById("range1m");
let displaValTwom=document.getElementById("range2m");
// let minGap=10000;
let sliderTrackm = document.querySelector(".slider-trackm");
let sliderMaxValuem = document.getElementById("slider-1m").max;


function slideOnem(){
  if(parseInt(sliderTwom.value) -parseInt
  (sliderOnem.value) <= minGap){
    sliderOnem.value=parseInt(sliderTwom.value)
    -minGap;
  }
  nilai1m =sliderOnem.value;
  function rubah(angka){
    var reverse = angka.toString().split('').reverse().join(''),
    ribuan = reverse.match(/\d{1,3}/g);
    ribuan = ribuan.join('.').split('').reverse().join('');
    return ribuan;
  }
  displaValOnem.textContent=rubah(nilai1m);
  fillcolorm();
}
function slideTwom(){
  if(parseInt(sliderTwom.value) -parseInt
  (sliderOnem.value) <= minGap){
    sliderTwom.value=parseInt(sliderOnem.value)
    + minGap;
  }
  nilai2m =sliderTwom.value;
  function rubah(angka){
    var reverse = angka.toString().split('').reverse().join(''),
    ribuan = reverse.match(/\d{1,3}/g);
    ribuan = ribuan.join('.').split('').reverse().join('');
    return ribuan;
  }
  displaValTwom.textContent=rubah(nilai2m);
  fillcolorm();
}

function fillcolorm(){
  percent1m = (sliderOnem.value / sliderMaxValuem) * 100;
  percent2m = (sliderTwom.value / sliderMaxValuem) * 100;
  sliderTrackm.style.background = `linear-gradient(to right, #dadae5  ${percent1m}% , #99999e ${percent1m}% , #99999e ${percent2m}% , #dadae5  ${percent2m}%)`;
  console.log(sliderTrackm.style.background);
}

// ----------------------------FILTER HARGA MOBILE


