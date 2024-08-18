<style>
    .changeProfile img {
        opacity: 1;
        transition: opacity .2s ease-in-out;
    }

    .changeProfile .content {
        opacity: 0;
        transition: opacity .2s ease-in-out;
    }

    .changeProfile:hover img {
        opacity: .7;
    }

    .changeProfile:hover .content {
        opacity: 1;
    }
</style>

<script>
    function displaySelectedFile() {
        const fileInput = document.getElementById("profile_picture")
        const fileText = document.getElementById("selectedFile")
        const button = document.getElementById("pictureButton")

        if (fileInput.files.length > 0) {
            const selectedFile = fileInput.files[0]
            const allowedTypes = ["image/jpeg", "image/jpg", "image/png", "image/gif"]

            if (allowedTypes.includes(selectedFile.type)) {
                fileText.textContent = `Selected file: ${selectedFile.name}`
                button.classList.remove('hidden')
            } else {
                fileText.textContent = "Invalid file type. Please select an image (JPEG, JPG, PNG, GIF)."
                fileInput.value = ""
                button.classList.add('hidden')
            }
        } else {
            fileText.textContent = `No file selected`
        }
    }
</script>