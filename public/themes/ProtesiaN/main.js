const pricesSwiper = new Swiper('.prices-swiper',{
    loop: true,
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    // slidesPerView: 3,
    // spaceBetween: 0,
    centeredSlides: true,
    initialSlide: 1,
    // effect: 'cards',
    // cardsEffect: {
    //     slideShadows: false,
    //     perSlideOffset: 15,
    //     perSlideRotate: 2,
    //     rotate: false,
    // },
    simulateTouch: true,
    grabCursor: true,
    slideToClickedSlide: true,
    spaceBetween: 0,
    breakpoints: {
        // when window width is >= 320px
        320: {
            slidesPerView: 1,
        },
        // when window width is >= 640px
        640: {
            slidesPerView: 2,
        },
        1024: {
            slidesPerView: 2,
        },
        1400: {
            slidesPerView: 3,
        },
        2000: {
            slidesPerView: 4,
        },
    }
});

// const pageSwiper = new Swiper('.page-swiper',{
//     direction: 'vertical',
//     loop: false,
//     pagination: {
//       el: '.swiper-pagination',
//       clickable: true,
//       // dynamicBullets: true,
//     },
//     slidesPerView: 1,
//     spaceBetween: 0,
//     centeredSlides: false,
//     initialSlide: 0,
//     effect: 'slide',
//     keyboard: {
//       enabled: true,
//       onlyInViewport: false,
//       pageUpDown: true,
//     },
//     mousewheel: {
//       sensitivity: 1,
//     },
//     simulateTouch: false,
//     speed: 500,
// })

var pageSwiper = new Swiper('.page-swiper', {
    speed: 600,
    parallax: true,
    pagination: {
        el: '.page-pagination',
        clickable: true,
    },
    direction: 'vertical',
    keyboard: {
        enabled: true,
        onlyInViewport: false,
        pageUpDown: true,
    },
    mousewheel: {
        sensitivity: 1,
    },
    simulateTouch: false,
    initialSlide: 0,
});

// DOM Elements
const tabs = document.querySelectorAll('.tab')
const tabContents = document.querySelectorAll('.tabcontent')

// Functions
const activateTab = tabnum => {

    tabs.forEach( tab => {
        tab.classList.remove('active')
    })

    tabContents.forEach( tabContent => {
        tabContent.classList.remove('active')
    })

    document.querySelector('#tab' + tabnum).classList.add('active')
    document.querySelector('#tabcontent' + tabnum).classList.add('active')
    localStorage.setItem('jstabs-opentab', JSON.stringify(tabnum))

}

// Event Listeners
tabs.forEach(tab => {
    tab.addEventListener('click', () => {
        activateTab(tab.dataset.tab)
    })
})


// Retrieve stored data
const opentab =  JSON.parse(localStorage.getItem('jstabs-opentab')) || '1'

// and..... Action!

activateTab(opentab)

function toggleDropdown() {
    document.getElementById("dropdown").classList.toggle('hidden');
}
