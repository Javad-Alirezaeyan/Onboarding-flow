<template>
    <input type="file" id="file" ref="file"  class="dropify" v-on:change="handleFileUpload()" />
</template>

<script>
    export default {
        name: "file-upload",
        data(){
            return {
                file: ''
            }
        },

        methods: {

            submitFile(){
                let formData = new FormData();
                formData.append('file', this.file);
                axios.post( '/uploadFile',
                    formData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }
                ).then(function(data){
                  //  console.log('SUCCESS!!');
                    swal("SUCCESS", "Your file uploaded successfully", "success");
                }).catch(function(e){
                        console.log('error:', e);
                    swal("ERROR", "Ther was an error", "warning");
                    });
            },

            /*
              Handles a change on the file upload
            */
            handleFileUpload(){
                this.file = this.$refs.file.files[0];
                this.submitFile()
            }
        }
    }
</script>