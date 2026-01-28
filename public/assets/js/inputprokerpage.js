/* =========================================
   Global Variables & Initialization
   ========================================= */
let currentStep = 1;
const totalSteps = 5;

$(document).ready(function() {
    // Init DataTable
    $('#dataproker-ajuan').DataTable({
        "language": {
            "paginate": {
                "previous": "<i class='mdi mdi-chevron-left'>",
                "next": "<i class='mdi mdi-chevron-right'>"
            }
        },
        "drawCallback": function () {
            $('.dataTables_paginate > .pagination').addClass('pagination-rounded');
        }
    });

    // Init Select2
    $('#luaran').select2({
        placeholder: "Pilih Luaran (Bisa Multiple)",
        allowClear: true,
        width: '100%' 
    });
});

/* =========================================
   Wizard Logic
   ========================================= */
function changeStep(direction) {
    // Validasi saat maju
    if (direction === 1 && !validateStep(currentStep)) {
        return;
    }

    const nextStep = currentStep + direction;

    if (nextStep > 0 && nextStep <= totalSteps) {
        // Jika masuk ke Step 3, generate input luaran
        if (nextStep === 3) {
            generateDetailLuaran();
        }

        document.getElementById(`step-${currentStep}`).classList.remove('active');
        document.getElementById(`step-${nextStep}`).classList.add('active');
        currentStep = nextStep;
        updateUI();
    }
}

function updateUI() {
    const btnPrev = document.getElementById('btn-prev');
    const btnNext = document.getElementById('btn-next');
    const btnSubmit = document.getElementById('btn-submit');

    // Tombol Kembali
    if (currentStep === 1) {
        btnPrev.classList.add('d-none');
    } else {
        btnPrev.classList.remove('d-none');
    }

    // Tombol Lanjut & Simpan
    if (currentStep === totalSteps) {
        btnNext.classList.add('d-none');
        btnSubmit.classList.remove('d-none');
    } else {
        btnNext.classList.remove('d-none');
        btnSubmit.classList.add('d-none');
    }

    // Update Indikator
    for (let i = 1; i <= totalSteps; i++) {
        const indicator = document.getElementById(`indicator-${i}`);
        const line = document.getElementById(`line-${i-1}`);

        indicator.classList.remove('active', 'completed');
        if (line) line.classList.remove('active');

        if (i < currentStep) {
            indicator.classList.add('completed');
            indicator.innerHTML = '&#10003;';
            if (line) line.classList.add('active');
        } else if (i === currentStep) {
            indicator.classList.add('active');
            indicator.innerHTML = i;
        } else {
            indicator.innerHTML = i;
        }
    }
}

function validateStep(step) {
    const currentStepDiv = document.getElementById(`step-${step}`);
    const inputs = currentStepDiv.querySelectorAll('input:not([disabled]), select:not([disabled]), textarea:not([disabled])');
    let isValid = true;

    inputs.forEach(input => {
        if (!input.checkValidity()) {
            isValid = false;
            input.reportValidity();
        }
    });

    return isValid;
}

/* =========================================
   Dynamic Form Functions
   ========================================= */
function generateDetailLuaran() {
    const selectLuaran = document.getElementById('luaran');
    const container = document.getElementById('container-detail-luaran');
    
    container.innerHTML = '';
    let hasSelection = false;

    for (let i = 0; i < selectLuaran.options.length; i++) {
        const option = selectLuaran.options[i];
        if (option.selected) {
            hasSelection = true;
            const idLuaran = option.value;
            const namaLuaran = option.text;

            const htmlInput = `
                <div class="mb-3 fade-in-up">
                    <label class="form-label fw-bold text-dark">
                        Target untuk: <span class="text-primary">${namaLuaran}</span>
                    </label>
                    <div class="input-group">
                        <input type="number" class="form-control" name="target_luaran[${idLuaran}]" placeholder="Masukkan angka target" required>
                        <span class="input-group-text">Satuan/Orang/Buah</span>
                    </div>
                </div>
                <hr class="dashed">
            `;
            container.insertAdjacentHTML('beforeend', htmlInput);
        }
    }

    if (!hasSelection) {
        container.innerHTML = '<div class="alert alert-warning">Anda belum memilih Luaran di langkah sebelumnya.</div>';
    }
}

function cekSasaran(element) {
    var divLainnya = document.getElementById('div-lainnya');
    var inputLainnya = document.getElementById('lainnya');

    if (element.value === "Lainnya") {
        divLainnya.classList.remove('d-none');
        inputLainnya.removeAttribute('disabled');
        inputLainnya.setAttribute('required', 'required');
    } else {
        divLainnya.classList.add('d-none');
        inputLainnya.setAttribute('disabled', 'disabled');
        inputLainnya.removeAttribute('required');
        inputLainnya.value = '';
    }
}

/* =========================================
   AJAX & Input Handling
   ========================================= */
function cariMahasiswa(nim) {
    if(!nim) return;

    const inputNamaDisplay = document.getElementById('nama_pic_display');
    const inputNamaValue = document.getElementById('nama_pic_value');
    const errorMsg = document.getElementById('error-nim');

    inputNamaDisplay.value = "Sedang mencari...";
    errorMsg.classList.add('d-none');

    // Pastikan URL fetch sesuai dengan route framework Anda
    fetch(`/dashboard/cek-mahasiswa/${nim}`)
        .then(response => {
            if (!response.ok) throw new Error('Mahasiswa tidak ditemukan');
            return response.json();
        })
        .then(data => {
            if(data.status === 'success') {
                inputNamaDisplay.value = data.nama;
                inputNamaValue.value = data.nama;
                inputNamaDisplay.classList.add('is-valid'); 
                inputNamaDisplay.classList.remove('is-invalid');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            inputNamaDisplay.value = "";
            inputNamaValue.value = "";
            errorMsg.classList.remove('d-none');
            inputNamaDisplay.classList.remove('is-valid');
            inputNamaDisplay.classList.add('is-invalid');
        });
}

// Handler Input HP (Max 14 digit & Auto 62)
const inputHP = document.getElementById('no_hp_pic');
if(inputHP) {
    inputHP.addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, ''); // Hanya angka

        if (value.length > 0) {
            if (value.startsWith('0')) {
                value = '62' + value.substring(1);
            } else if (!value.startsWith('62')) {
                value = '62' + value;
            }
        }

        // Limit Max 14 Digit
        if (value.length > 14) {
            value = value.substring(0, 14);
        }

        e.target.value = value;
    });

    inputHP.addEventListener('blur', function(e) {
        if (e.target.value.length > 0 && e.target.value.length < 10) {
            alert('Nomor HP terlalu pendek. Pastikan nomor valid.');
        }
    });
}

$(document).ready(function() {
        $('#dataproker').DataTable({
            "language": {
                "paginate": {
                    "previous": "<i class='mdi mdi-chevron-left'>",
                    "next": "<i class='mdi mdi-chevron-right'>"
                }
            },
            "drawCallback": function () {
                $('.dataTables_paginate > .pagination').addClass('pagination-rounded');
            }
        });
    });
/* =========================================
   End of File
   ========================================= */

   $(document).ready(function() {
        console.log("Script Modal Aktif!"); // Cek di Console Browser (F12)

        // Event listener untuk saat modal akan ditampilkan
        $('#confirmModal').on('show.bs.modal', function (event) {
            
            // 1. Ambil tombol yang diklik
            var button = $(event.relatedTarget); 
            
            // 2. Ambil data dari atribut tombol
            var url = button.data('url');
            var message = button.data('message');
            var btnColor = button.data('btn-color');
            var btnText = button.data('btn-text');

            // Debugging: Pastikan data terbaca (Lihat Console F12)
            console.log("URL:", url); 

            // 3. Update isi Modal
            var modal = $(this);

            // Update Action Form
            modal.find('#modalForm').attr('action', url);
            
            // Update Pesan
            modal.find('#modalMessage').text(message);
            
            // Update Tombol Konfirmasi
            var confirmBtn = modal.find('#modalConfirmBtn');
            
            // Hapus class warna lama, tambah yang baru
            confirmBtn.removeClass('btn-success btn-danger btn-primary btn-warning')
                      .addClass(btnColor)
                      .text(btnText);
        });
    });