document.addEventListener("DOMContentLoaded", function () {
    // Get the download button by its ID
    const downloadButton = document.getElementById("download-button");
  
    downloadButton.addEventListener("click", function () {
      // Capture the content of the invoice using HTML2Canvas
      html2canvas(document.querySelector(".invoice")).then((canvas) => {
        // Convert the captured content to a data URL
        const imgData = canvas.toDataURL("image/png");
  
        // Create a PDF document using jsPDF
        const pdf = new jsPDF();
        pdf.addImage(imgData, "PNG", 10, 10, 180, 240);
  
        // Download the PDF with the name "invoice.pdf"
        pdf.save("invoice.pdf");
      });
    });
  });
  