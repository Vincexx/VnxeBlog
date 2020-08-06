<template>
    <div class="col-md-8">

        <div class="preImages">
            <img :src="previewImage1 ? previewImage1 : previewImage"
                class="rounded w-100"
                alt="..."
                @click="openUpload(id=1)"
            >

            <img :src="previewImage2 ? previewImage2 : previewImage"
                class="rounded w-100"
                alt="..."
                @click="openUpload(id=2)"
            >

            <img :src="previewImage3 ? previewImage3 : previewImage"
                class="rounded w-100"
                alt="..."
                @click="openUpload(id=3)"
            >

        </div>



        <div class="text-center mx-auto">
            <button class="btn btn-primary mt-3 mx-auto" @click="uploadImage()">Upload</button>
            <input type="file" name="image" id="image1" class="d-none" @change="fileChange">
            <input type="file" name="image" id="image2" class="d-none" @change="fileChange">
            <input type="file" name="image" id="image3" class="d-none" @change="fileChange">
        </div>


    </div>

</template>

<script>
    export default {
        data() {
            return {
                previewImage : ['/storage/product_images/no-preview-available.png'],
                previewImage1 : '',
                previewImage2 : '',
                previewImage3 : '',
                imageId : '',
                attachment : null,
                form : new FormData,
                images : ['1', '2', '3'],
            }
        },
        methods : {
            fileChange(e) {
                if(this.imageId === 1) {
                    this.images[0] = e.target.files[0]
                } else if(this.imageId === 2) {
                    this.images[1] = e.target.files[0]
                } else if(this.imageId === 3) {
                    this.images[2] = e.target.files[0]
                }

                var reader, files = e.target.files

                console.log(files.length);

                if(files.length === 0) {
                    console.log('empty');
                }

                reader = new FileReader()

                reader.onload = (e) => {
                    if(this.imageId === 1) {
                        this.previewImage1 = e.target.result
                    } else if (this.imageId === 2) {
                        this.previewImage2 = e.target.result
                    } else if (this.imageId === 3) {
                        this.previewImage3 = e.target.result
                    }
                }

                if (files[0]) {
                    reader.readAsDataURL(files[0])
                } else if (files[1]) {
                    reader.readAsDataURL(files[1])
                } else if (files[2]) {
                    reader.readAsDataURL(files[2])
                }

            },
            uploadImage() {
                this.images.forEach(image => {
                    this.form.append('image', image)

                    const config = { headers: { 'Content-Type' : 'multipart/form-data' } };

                    axios.post('/api/images', this.form,config)
                    .then(res => {
                        console.log(res);
                    }).catch(err => console.log(err))
                });
            },
            openUpload(id) {
                if(id === 1) {
                    this.imageId = id
                    document.getElementById('image1').click()
                } else if (id === 2) {
                    this.imageId = id
                    document.getElementById('image2').click()
                } else {
                    this.imageId = id
                    document.getElementById('image3').click()
                }
            }
        }
    }
</script>

<style lang="scss" scoped>

    .preImages {
        display: grid;
        grid-gap: 20px;
        grid-template-columns: 1fr 1fr 1fr;
        justify-items: center;

    }

</style>
