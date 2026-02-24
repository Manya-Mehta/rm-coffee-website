const productContainers = [...document.querySelectorAll('.product-container')];
const nxtBtn = [...document.querySelectorAll('.nxt-btn')];
const preBtn = [...document.querySelectorAll('.pre-btn')];

productContainers.forEach((item, i) => {
    let containerDimenstions = item.getBoundingClientRect();
    let containerWidth = containerDimenstions.width;

    nxtBtn[i].addEventListener('click', () => {
        item.scrollLeft += containerWidth;
    })

    preBtn[i].addEventListener('click', () => {
        item.scrollLeft -= containerWidth;
    })
})
    document.getElementById('blog-link').addEventListener('click', function(e) {
        e.preventDefault(); 
        document.getElementById('cafe').scrollIntoView({ behavior: 'smooth' });
    });

function visitCafe() {
    window.location.href = "blog.html";  
}
