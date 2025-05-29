var i = 0;
var images = []; //array
var time = 4000; // time in milliseconds

// Fetch background images from the server
function fetchBackgroundImages() {
    fetch('get_background_images.php')
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            if (data.error) {
                console.error('Server error:', data.error);
                return;
            }
            if (Array.isArray(data) && data.length > 0) {
                // Use the correct path for images in root images folder
                images = data.map(img => `url(${img.path})`);
                console.log('Loaded images:', images); // Debug log
                changeImage(); // Start the slideshow if we have images
            } else {
                console.log('No background images found');
            }
        })
        .catch(error => {
            console.error('Error fetching background images:', error);
            // You might want to set a default background here
            document.getElementById('background').style.backgroundImage = 'url(images/default-background.jpg)';
        });
}

//function to change image
function changeImage() {
    var el = document.getElementById('background');
    if (images.length > 0) {
        console.log('Setting background to:', images[i]); // Debug log
        el.style.backgroundImage = images[i];
        el.style.backgroundSize = 'cover';
        el.style.backgroundPosition = 'center';
        el.style.backgroundRepeat = 'no-repeat';
        el.style.backgroundAttachment = 'fixed';
        
        if (i < images.length - 1) {
            i++;
        } else {
            i = 0;
        }
        setTimeout('changeImage()', time);
    }
}

window.onload = fetchBackgroundImages;