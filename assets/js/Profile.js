
        const uploadPhotoButton = document.getElementById('upload-photo');
        const removePhotoButton = document.getElementById('remove-photo');
        const photoUploadInput = document.getElementById('photo-upload');
        const profilePhoto = document.getElementById('profile-photo');
        const closeButton = document.getElementById('closeButton');
        const saveButton = document.getElementById('save-changes');
        
        // Upload photo functionality
        uploadPhotoButton.addEventListener('click', () => {
            photoUploadInput.click();
        });

        photoUploadInput.addEventListener('change', (event) => {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    profilePhoto.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });

        // Remove photo functionality
        removePhotoButton.addEventListener('click', () => {
            profilePhoto.src = "https://via.placeholder.com/132";
        });

        // Save data functionality
        saveButton.addEventListener('click', (e) => {
            e.preventDefault();
            const profileData = {
                fullName: document.getElementById('full-name').value,
                email: document.getElementById('email').value,
                company: document.getElementById('company').value,
                position: document.getElementById('position').value,
                class: document.getElementById('class').value,
                photo: profilePhoto.src
            };

            // Save data to local storage
            localStorage.setItem('profileData', JSON.stringify(profileData));
            alert('Changes saved!');
        });

        // Close button warning
        closeButton.addEventListener('click', () => {
            if (confirm('Are you sure you want to close? Unsaved changes will be lost.')) {
                localStorage.clear(); // Clear all saved data
                location.reload(); // Reset form
                window.location.href = 'index.php';
            }
        });
