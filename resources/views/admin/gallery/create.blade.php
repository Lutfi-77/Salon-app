@extends('admin.template.app')

@section('css')
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endsection

@section('title', 'Admin Gallery')

@section('content')
<div class="mt-5 col-span-12 rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark xl:col-span-4 py-3">
    <div class="container mx-auto">
        <form action="{{route('admin.gallery.store')}}" class="dropzone" id="my-dropzone" enctype="multipart/form-data">
            @csrf
            <div class="fallback">
              <input name="images[]" type="file" multiple />
            </div>
        </form>
        <button class="border py-1 px-5 rounded-lg mt-5 bg-green-500 text-white" id="saveImage">Simpan</button>
    </div>
</div>
@endsection

@push('js')
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
<script>
    // Note that the name "myDropzone" is the camelized
    // id of the form.
    let saveImage = document.querySelector('#saveImage');
    Dropzone.options.myDropzone = {
        autoProcessQueue: false,
        uploadMultiple: true,
        paramName: "images",
        parallelUploads: 10,
        maxFiles: 10,
        acceptedFiles: ".jpeg,.jpg,.png,.gif",
        addRemoveLinks: true,
        timeout: 50000,
        headers: {
            'X-CSRF-TOKEN': '{{csrf_token()}}'
        },

        init: function() {
            var myDropzone = this;
            let formData = $('#my-dropzone').serialize()

            $.ajax({
					url: "{{route('admin.gallery.store')}}",
					type: 'POST',
					dataType: 'json',
                    data: formData,
					success: function(data){
					    console.log("data");
					}
				});

            // First change the button to actually tell Dropzone to process the queue.
            saveImage.addEventListener("click", function(e) {
            // Make sure that the form isn't actually being sent.
                e.preventDefault();
                e.stopPropagation();
                myDropzone.processQueue();
            });

            // Listen to the sendingmultiple event. In this case, it's the sendingmultiple event instead
            // of the sending event because uploadMultiple is set to true.
            this.on("sendingmultiple", function() {
                // Gets triggered when the form is actually being sent.
                // Hide the success button or the complete form.
                console.log(1)
            });
            this.on("successmultiple", function(files, response) {
                // Gets triggered when the files have successfully been sent.
                // Redirect user or notify of success.
                console.log(response);
                window.location = '{{route("admin.gallery")}}';
            });
            this.on("errormultiple", function(files, response) {
                // Gets triggered when there was an error sending the files.
                // Maybe show form again, and notify user of error
            });
        }
    };
  </script>
@endpush