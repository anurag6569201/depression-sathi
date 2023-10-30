var onepng=document.getElementById("onepng");
var twopng=document.getElementById("twopng");
var threepng=document.getElementById("threepng");
var farward_arr1=document.getElementById("farward_arr1");
var farward_arr2=document.getElementById("farward_arr2");
var farward_arr3=document.getElementById("farward_arr3");

function show_anim1(){
    onepng.src="images/11.png";
    farward_arr1.style.scale="1.06";
    farward_arr1.style.left="1.8em";
}
function remove_anim1(){
    onepng.src="images/1.png";
    farward_arr1.style.scale="1";
    farward_arr1.style.left="1.5em";

}

function show_anim2(){
    twopng.src="images/22.png";
    farward_arr2.style.scale="1.06";
    farward_arr2.style.left="1.8em";
}
function remove_anim2(){
    twopng.src="images/2.png";
    farward_arr2.style.scale="1";
    farward_arr2.style.left="1.5em";
}

var msc_relax = document.getElementById("msc_relax");
var msc_inspiration = document.getElementById("msc_inspiration");
var msc_self_care = document.getElementById("msc_self_care");
var msc_positivity = document.getElementById("msc_positivity");
var msc_calm = document.getElementById("msc_calm");
var btn1 = document.getElementById("btn1");
var btn2 = document.getElementById("btn2");
var btn3 = document.getElementById("btn3");
var btn4 = document.getElementById("btn4");
var btn5 = document.getElementById("btn5");

function msc_btn1() {
  msc_relax.style.display = "block";
  msc_calm.style.display = "none";
  msc_inspiration.style.display = "none";
  msc_positivity.style.display = "none";
  msc_self_care.style.display = "none";
  btn1.style.background = "#afc6dd";
  btn2.style.background = "";
  btn3.style.background = "";
  btn4.style.background = "";
  btn5.style.background = "";
}

function msc_btn2() {
  msc_relax.style.display = "none";
  msc_calm.style.display = "none";
  msc_inspiration.style.display = "block";
  msc_positivity.style.display = "none";
  msc_self_care.style.display = "none";
  btn1.style.background = "";
  btn2.style.background = "#afc6dd";
  btn3.style.background = "";
  btn4.style.background = "";
  btn5.style.background = "";
}

function msc_btn3() {
  msc_relax.style.display = "none";
  msc_calm.style.display = "none";
  msc_inspiration.style.display = "none";
  msc_positivity.style.display = "none";
  msc_self_care.style.display = "block";
  btn1.style.background = "";
  btn2.style.background = "";
  btn3.style.background = "#afc6dd";
  btn4.style.background = "";
  btn5.style.background = "";
}

function msc_btn4() {
  msc_relax.style.display = "none";
  msc_calm.style.display = "none";
  msc_inspiration.style.display = "none";
  msc_positivity.style.display = "block";
  msc_self_care.style.display = "none";
  btn1.style.background = "";
  btn2.style.background = "";
  btn3.style.background = "";
  btn4.style.background = "#afc6dd";
  btn5.style.background = "";
}

function msc_btn5() {
  msc_relax.style.display = "none";
  msc_calm.style.display = "block";
  msc_inspiration.style.display = "none";
  msc_positivity.style.display = "none";
  msc_self_care.style.display = "none";
  btn1.style.background = "";
  btn2.style.background = "";
  btn3.style.background = "";
  btn4.style.background = "";
  btn5.style.background = "#afc6dd";
}
function setDefaultButton() {
  msc_btn1();
}
window.onload = setDefaultButton;