// for edit-user page image change 
document.getElementById('image').addEventListener('change', function(event) {
    var file = event.target.files[0]; // Get the selected file
    if (file) {
        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('show_profile_image').src = e.target.result; // Update image preview
        }
        reader.readAsDataURL(file); // Convert to base64 URL
    }
});

