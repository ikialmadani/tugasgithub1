<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Latihan Memproses Form</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    </head>

    <body>
    <div class="container px-5 my-5">
    <form method="POST" >
        <div class="form-floating mb-3">
            <input class="form-control" name="namapegawai" id="namaPegawai" type="text" placeholder="Nama Pegawai" data-sb-validations="required" />
            <label for="namaPegawai">Nama Pegawai</label>
            <div class="invalid-feedback" data-sb-feedback="namaPegawai:required">Nama Pegawai is required.</div>
        </div>
        <div class="form-floating mb-3">
            <select class="form-select" name="agama" id="agama" aria-label="Agama">
                <option value="Islam">Islam</option>
                <option value="Kristen">Kristen</option>
                <option value="Hindu">Hindu</option>
                <option value="Budha">Budha</option>
            </select>
            <label for="agama">Agama</label>
        </div>
        <div class="mb-3">
            <label class="form-label d-block">Jabatan</label>
            <div class="form-check form-check-inline">
                <input class="form-check-input" value="manager"  id="manager" type="radio" name="jabatan" data-sb-validations="" />
                <label class="form-check-label" for="manager">Manager</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" value="asisten" id="asisten" type="radio" name="jabatan" data-sb-validations="" />
                <label class="form-check-label" for="asisten">Asisten</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" value="kabag" id="kabag" type="radio" name="jabatan" data-sb-validations="" />
                <label class="form-check-label" for="kabag">Kabag</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" value="staff" id="staff" type="radio" name="jabatan" data-sb-validations="" />
                <label class="form-check-label" for="staff">Staff</label>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label d-block">Status</label>
            <div class="form-check form-check-inline">
                <input class="form-check-input" value="menikah" id="menikah" type="radio" name="status" data-sb-validations="" />
                <label class="form-check-label" for="menikah">Menikah</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" value="tidakmenikah" id="tidakMenikah" type="radio" name="status" data-sb-validations="" />
                <label class="form-check-label" for="tidakMenikah">Tidak Menikah</label>
            </div>
        </div>
        <div class="form-floating mb-3">
            <input class="form-control" name="jumlahanak" id="jumlahAnak" type="text" placeholder="Jumlah Anak" data-sb-validations="required" />
            <label for="jumlahAnak">Jumlah Anak</label>
            <div class="invalid-feedback" data-sb-feedback="jumlahAnak:required">Jumlah Anak is required.</div>
        </div>
        <div class="d-none" id="submitSuccessMessage">
            <div class="text-center mb-3">
                <div class="fw-bolder">Form submission successful!</div>
                <p>To activate this form, sign up at</p>
                <a href="https://startbootstrap.com/solution/contact-forms">https://startbootstrap.com/solution/contact-forms</a>
            </div>
        </div>
        <div class="d-none" id="submitErrorMessage">
            <div class="text-center text-danger mb-3">Error sending message!</div>
        </div>
        <div class="d-grid">
            <button class="btn btn-primary btn-lg " name="submit" type="submit">Submit</button>
        </div>
    </form>
</div>

       
       
        
        <?php 
        if (isset($_POST["submit"])) {
            $namapegawai=$_POST["namapegawai"];
            $agama=$_POST["agama"];
            $jabatan=$_POST["jabatan"];
            $status=$_POST["status"];
            $jumlahanak=$_POST["jumlahanak"];

        switch ($jabatan) {
            case 'manager': $gajipokok=20000000; break;
            case 'asisten': $gajipokok=15000000; break;
            case 'kabag': $gajipokok=10000000; break;
            case 'staff': $gajipokok=40000000; break;

            default:
                # code...
                break;
        }
        $tunjanganjabatan = 20 * $gajipokok / 100;
        if ($status == "menikah" && $jumlahanak <= 2 ) {
            $tunjangankeluarga = 5 * $gajipokok / 100 ;
        }
        elseif ($status == "menikah" && $jumlahanak <= 5) {
            $tunjangankeluarga = 10 * $gajipokok / 100;
        }
        elseif ($status == "menikah" && $jumlahanak > 5) {
            $tunjangankeluarga = 15 * $gajipokok / 100;
        }
        else {
            $tunjangankeluarga=0 ;
        }

        $gajikotor = $gajipokok + $tunjanganjabatan + $tunjangankeluarga;
        $zakatprofesi = ($agama == "Islam" && $gajikotor >= 6000000) ? (2.5 * $gajikotor) / 100 : 0;
        
        $takehomepay = $gajikotor - $zakatprofesi ;
        ?>
        <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Nama Pegawai : <?=$namapegawai?> </p>
        <p>Agama : <?=$agama?> </p>
        <p>Jabatan : <?=$jabatan?> </p>
        <p>Status : <?=$status?> </p>
        <p>Jumlah Anak : <?=$jumlahanak?> </p>
        <p>Tunjangan Keluarga : <?="Rp.".number_format($tunjangankeluarga)?> </p>
        <p>Tunjangan Jabatan : <?="Rp.".number_format($tunjanganjabatan)?> </p>
        <p>Zakat Profesi : <?="Rp.".number_format($zakatprofesi)?> </p>
        <p>Gaji Pokok : <?="Rp.".number_format($gajipokok)?> </p>
        <p>Gaji Kotor : <?="Rp.".number_format($gajikotor)?> </p>





      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
        </div>
    </div>
    </div>

        <?php
        }
        ?>
        <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
       </script>
       <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
            <script>
                const modal = new bootstrap.Modal("#exampleModal")
                modal.show()
            </script>
    </body>

</html>