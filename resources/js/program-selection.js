const programSchedNav = document.getElementById('programs');
const teacherSchedNav = document.getElementById('teachers');

const programsCont = document.getElementById('programscontainer');
const teachersCont= document.getElementById('teacherscontainer');

console.log(programsCont.classList);

teacherSchedNav.addEventListener('click', (e) => {
    if (teacherSchedNav.checked) {
        programsCont.classList.add('hidden');
        teachersCont.classList.remove('hidden');
    }
})

programSchedNav.addEventListener('click', (e) => {
    if (programSchedNav.checked) {
        programsCont.classList.remove('hidden');
        teachersCont.classList.add('hidden');
    }
})