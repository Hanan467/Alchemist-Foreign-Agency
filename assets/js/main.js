const profile = document.getElementById("navbarDropdownMenuLink");
const items = document.querySelector('.dropdown-menu');

profile.addEventListener('click',function(){
      items.classList.toggle('show');
}
);

function displaySelectedImage(event, elementId) {
    const selectedImage = document.getElementById(elementId);
    const fileInput = event.target;
  
    if (fileInput.files && fileInput.files[0]) {
        const reader = new FileReader();
  
        reader.onload = function(e) {
            selectedImage.src = e.target.result;
        };
  
        reader.readAsDataURL(fileInput.files[0]);
    }
  }

