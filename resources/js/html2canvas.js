import html2canvas from 'html2canvas';

const element = document.getElementById("timetable");

const exportPdf = document.getElementById('exportPdf');
const exportJpg = document.getElementById('exportJpg');

exportPdf.addEventListener('click', () => {            
    element.classList.remove('hidden');     
    
    const isSmallDevice = window.innerWidth < 768;

    const opt = {
        margin:       0.25,           // inches
        filename:     'SCHEDULE.pdf',
        image:        { type: 'jpeg', quality: 0.98 },
        html2canvas:  { 
            scale: 2,
            scrollX: 0,
            scrollY: 0,
        },  
        jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
    };
    
    html2pdf().set(opt).from(element).save();
    
    setTimeout(() => {
        element.classList.add('hidden');
    }, 2000);
});

exportJpg.addEventListener('click', async () => {
        // // Make sure timetable is visible before capturing
        element.classList.remove('hidden');

        // // Wait a moment to allow reflow (important when element is toggled)
        
        await new Promise(resolve => setTimeout(resolve, 300));
        
        // Capture using html2canvas
        const canvas = await html2canvas(element, { 
            scale: 2,
        }); 

        // Convert canvas to JPG
        const imageData = canvas.toDataURL('image/jpeg', 0.98);

        // Create a temporary download link
        const link = document.createElement('a');
        link.href = imageData;
        link.download = 'SCHEDULE.jpg';
        link.click();

        // Hide timetable again
        element.classList.add('hidden');
});