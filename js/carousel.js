let nextDom = document.getElementById('next');
let prevDom = document.getElementById('prev');
let carouselDom = document.querySelector('.carousel');
let listItemDom = document.querySelector('.carousel .list');
let thumbnailDom = document.querySelector('.carousel .thumbnail');

// Función para manejar el evento click del botón "next"
 nextDom.onclick = function(){
    showSlider('next');
 }
 // Función para manejar el evento click del botón "prev"
prevDom.onclick = function(){
    showSlider('prev');
}
let timeRunning = 9000; // Duración de la transición
let timeAutoNext = 10000; // Tiempo entre cambios automáticos
let runTimeOut;
let runAutoRun = setTimeout(()=>{
   nextDom.click();
}, timeAutoNext);

// Función para mostrar el slider

 function showSlider(type){
    let itemSlider = document.querySelectorAll('.carousel .list .item');
    let itemThumbnail = document.querySelectorAll('.carousel .thumbnail .item');

         if (type === 'next'){
             listItemDom.appendChild(itemSlider[0]);
             thumbnailDom.appendChild(itemThumbnail[0]);
             carouselDom.classList.add('next');

         }else{
            let positionLastItem = itemSlider.length - 1;
            listItemDom.prepend(itemSlider[positionLastItem]);
            thumbnailDom.prepend(itemThumbnail[positionLastItem]);
            carouselDom.classList.add('prev');
            
         }


     clearTimeout(runTimeOut);
     runTimeOut = setTimeout(() =>{
        carouselDom.classList.remove('next');   //  efecto transicion
        carouselDom.classList.remove('prev'); 
     },timeRunning);
     
 
     clearTimeout(runAutoRun);
     runAutoRun = setTimeout(() => {
      nextDom.click();
     }, timeAutoNext);
 

 }