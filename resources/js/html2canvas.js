import html2canvas from 'html2canvas';

const element = document.getElementById("timetable");

const exportJpg = document.getElementById('exportJpg');

exportJpg.addEventListener('click', async () => {
        element.classList.remove('hidden');

        await new Promise(resolve => setTimeout(resolve, 300));
        
        const canvas = await html2canvas(element, { 
            scale: 2,
        }); 

        const imageData = canvas.toDataURL('image/jpeg', 0.98);

        const link = document.createElement('a');
        link.href = imageData;
        link.download = 'SCHEDULE.jpg';
        link.click();

        element.classList.add('hidden');
});