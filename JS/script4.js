const klik=document.querySelector('.click-');
const geser=document.querySelector('.navigation-side-');
klik.addEventListener('click', function(){
    geser.classList.toggle('translate-')
});

const select=document.querySelector('.navigation-side- ul');
const exist=select.getElementsByTagName('li')[0];
const selected=exist.querySelector('a');
const clas=document.querySelector('.hide-');
selected.addEventListener('click',function(e){
  clas.classList.toggle('bravo-');
   e.preventDefault();
})


