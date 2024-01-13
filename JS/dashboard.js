
//pilih dulu elemen html nya
const cekbok=document.querySelector('.menu input');
const nav2=document.querySelector('.nav2')
//jika cekbox ditekan maka na2 geser kekanan
    cekbok.addEventListener('click',function(){
        nav2.classList.toggle('geser')});
