const navBarItems = [
    { 
        title: "programs", 
        icon: "book-white.svg", 
        mobileId: 'programsNav', 
        isChecked: true },
    { 
        title: "teachers", 
        icon: "user-white.svg", 
        mobileId: 'teachersNav', 
        isChecked: false 
    }
];

const sectionTitle = document.getElementById('sectionTitle');
const sectionIcon = document.getElementById('sectionIcon'); 

/*
* Web Navigation
*/ 

const webNavBarCont = document.getElementById('webNavBar');

/*
* Renders the navbar's items
*/ 
navBarItems.forEach(item => {
    const navItem = document.createElement('label');

    const isChecked = item.isChecked ? 'checked' : '';

    navItem.htmlFor = item.title;
    navItem.innerHTML = `   <img src="assets/icons/${item.icon}">
                            <input class="hidden" id="${item.title}" name='navigation' value='${item.title}' type="radio" ${isChecked}>
                            <p class="text-txtclr_white">${item.title.charAt(0).toUpperCase() + item.title.slice(1)}</p>`;
                        
    navItem.classList.add('flex', 'items-center', 'active:bg-bgcolor-gray', 'rounded-full', 'justify-center', 'px-12', 'py-4', 'gap-4', 'has-[input:checked]:bg-primary_pressed');

    webNavBarCont.appendChild(navItem);

    console.log('from forEach');
});

const programSchedNav = document.getElementById('programs');
const teacherSchedNav = document.getElementById('teachers');

const programsCont = document.getElementById('programscontainer');
const teachersCont= document.getElementById('teacherscontainer');

/*
* Shows Teacher Schedules
*/ 

teacherSchedNav.addEventListener('click', (e) => {
    if (teacherSchedNav.checked) {
        showTeacherCont();
        sectionTitle.textContent = 'Teachers';
        sectionIcon.src = `assets/icons/user-black.svg`;
    }
})

/*
* Shows All Programs
*/ 

programSchedNav.addEventListener('click', (e) => {
    if (programSchedNav.checked) {
        showProgramCont();
        sectionTitle.textContent = 'Programs';
        sectionIcon.src = `assets/icons/book-black.svg`;
    }
})

function showProgramCont() {
    programsCont.classList.remove('hidden');
    teachersCont.classList.add('hidden');
}

function showTeacherCont() {
    programsCont.classList.add('hidden');
    teachersCont.classList.remove('hidden');
}

/*
* Mobile Navigation
*/ 

const navPopUp = document.getElementById('nav-popup');
const navPopUpButton = document.getElementById('navPopUpButton');

navBarItems.forEach(item => {
    const popUpItem = document.createElement('label');

    popUpItem.htmlFor = item.title;

    popUpItem.innerHTML = ` <input class="hidden" id="${item.mobileId}" name='navigation' value='${item.title}' type="radio" ${item.isChecked}>
                            <p>${item.title.charAt(0).toUpperCase() + item.title.slice(1)}</p>`;
                        
    popUpItem.classList.add('flex', 'items-center', 'hover:bg-primary_hovered', 'active:bg-primary_pressed', 'rounded-full', 'justify-center', 'px-12', 'py-4', 'gap-4', 'has-[input:checked]:bg-primary_pressed');

    navPopUp.appendChild(popUpItem);
});

const programNav = document.getElementById('programsNav');
const teacherNav = document.getElementById('teachersNav');

navPopUpButton.addEventListener('click', (e) => {
    navPopUp.classList.toggle('hidden');
});

programNav.addEventListener('click', (e) => {
    if (navPopUp.contains(e.target)) {
        showProgramCont();
        navPopUp.classList.toggle('hidden');
    }
});

teacherNav.addEventListener('click', (e) => {
    if (navPopUp.contains(e.target)) {
        showTeacherCont();
        navPopUp.classList.toggle('hidden');
    }
});