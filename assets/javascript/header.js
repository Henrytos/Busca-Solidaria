const header = document.getElementById('header');

// Função para adicionar ou remover a classe com base na rolagem
window.addEventListener('scroll', () => {
  
  if (window.scrollY > 50) {
    header.classList.add('header-scroll');
  } else {
    header.classList.remove('header-scroll');
  }
});

// document.addEventListener("click", closeAllSelect);
function scrollright(){
  document.getElementById("section3").scrollLeft += 400;
}
function scrollleft(){
  document.getElementById("section3").scrollLeft -= 400;
}

const containe = document.querySelector('.containe');

document.addEventListener('mousemove', (e) => {
  const x = (e.clientX / window.innerWidth) * 100;
  const y = (e.clientY / window.innerHeight) * 100;
  
  containe.style.backgroundPosition = `${x}% ${y}%`;
});




let profileDropdownList = document.querySelector(".profile-dropdown-list");
let btn = document.querySelector(".profile-dropdown-btn");


  btn.addEventListener("click", ()=>{
    profileDropdownList.classList.toggle("active");
  });


window.addEventListener('click', function(e){
    if(!btn.contains(e.target))profileDropdownList.classList.remove('active');
});