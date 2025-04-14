<form action="{{ url('profile/update') }}" method="POST" id="form-edit-pfp" enctype="multipart/form-data">
    @csrf
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah Foto Profil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="form-group text-center">
                    <!-- Photo Preview Container -->
                    <img id="profile-preview" 
                         src="{{ asset('storage/profile/' . (Auth::user()->profile_photo ?? 'Foto.jpg')) }}"
                         class="img-thumbnail mb-3"
                         style="width: 100px; height: 100px; object-fit: cover; border-radius: 50%;">
                    
                    <div>
                        <label for="profile_photo">Pilih Foto Profil Baru</label>
                        <input type="file" name="profile_photo" id="profile_photo" 
                               class="form-control-file" required
                               onchange="previewProfilePhoto(this)">
                        <small id="error-profile_photo" class="error-text form-text text-danger"></small>
                        <div id="file-info" class="text-muted small mt-1">
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-warning">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</form>

<script>
// Function to preview selected photo
function previewProfilePhoto(input) {
    const preview = document.getElementById('profile-preview');
    const fileName = document.getElementById('file-name');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            preview.src = e.target.result;
        }
        
        reader.readAsDataURL(input.files[0]);
        fileName.textContent = input.files[0].name;
    } else {
        fileName.textContent = 'No file chosen';
    }
}

$(document).ready(function () {
    $("#form-edit-pfp").validate({
        rules: {
            profile_photo: {
                required: true,
                extension: "jpg|jpeg|png"
            }
        },
        submitHandler: function (form) {
            var formData = new FormData(form);

            $.ajax({
                url: form.action,
                type: form.method,
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    $('#myModal').modal('hide');
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: response.message || 'Foto profil berhasil diperbarui.'
                    }).then(() => {
                        location.reload();
                    });
                },
                error: function (xhr) {
                    $('.error-text').text('');
                    if (xhr.responseJSON?.errors) {
                        $.each(xhr.responseJSON.errors, function (key, val) {
                            $('#error-' + key).text(val[0]);
                        });
                    }
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: xhr.responseJSON?.message || 'Terjadi kesalahan saat mengupload foto.'
                    });
                }
            });

            return false;
        }
    });
});
</script>