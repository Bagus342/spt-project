const URL = document.getElementById('url').value;

const elementUpdate = document.getElementsByClassName('update');

function getUpdate() {
    for (let i = 0; i < elementUpdate.length; i++) {
        elementUpdate[i].addEventListener('click', function () {
            const id = this.getAttribute('data-id');
            document
                .getElementById('form-update')
                .setAttribute('action', URL + '/wilayah/' + id);

            fetch(`${URL}/wilayah/json/getWilayah/${id}`)
                .then(res => res.json())
                .then(res => {
                    document.querySelector('input[name=nama_wilayah]').value =
                        res.data_update.nama_wilayah;
                    document.querySelector('input[name=harga_wilayah]').value =
                        res.data_update.harga_wilayah;
                });
        });
    }
}

getUpdate();

document.getElementById('search').addEventListener('keyup', function () {
    const keyword = this.value;
    fetch(URL + '/wilayah/group/search?name=' + keyword)
        .then(res => res.json())
        .then(res => {
            document.getElementById('list-data').innerHTML = parseSearch(res);
            getUpdate();
            listDelete();
        });
});

const parseSearch = data => {
    let html = '';
    let no = 1;
    data.data.map(res => {
        console.log(res);
        html += elementSearch(res, no++);
    });
    return html;
};

const elementSearch = (res, no) => {
    let d = new Date(res.created_at);
    const date = `${d.getFullYear()}-${d.getMonth() + 1}-${d.getDate()}`;
    return /*html*/ `<tr>
    <td>${no}</td>
    <td>${res.nama_wilayah}</td>
    <td>${res.harga_wilayah}</td>
<td style="text-align: center;">

    <a href="#" class="btn btn-warning text-bold update"
        data-target="#modal-lg" data-toggle="modal"
        data-id="${res.id_wilayah}"><i class="fas fa-pencil-alt"></i>&nbsp;Ubah</a>
        <a href="/wilayah/${res.id_wilayah}" class="btn btn-danger text-bold delete"><i class="far fa-trash-alt"></i>&nbsp;Hapus</a>

</td>
</tr>`;
};

const formatTanggal = tgl => {
    const listMonth = [
        'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'November',
        'Desember',
    ];
    const month = tgl.split('-');
    return `${month[2]}/${listMonth[parseInt(month[1]) - 1]}/${month[0]}`;
};

function listDelete() {
    const documentDel = document.querySelectorAll('.delete');
    for (let i = 0; i < documentDel.length; i++) {
        documentDel[i].onclick = function (e) {
            e.preventDefault();
            swalDelete(this.getAttribute('href'));
        };
    }
}

function swalDelete(param) {
    Swal.fire({
        title: 'Yakin ingin Menghapus?',
        text: 'Data akan di hapus secara permanent!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya',
        cancelButtonText: 'Batal',
    }).then(result => {
        result.isConfirmed ? (window.location.href = param) : '';
    });
}

listDelete();

const flash = document.querySelector('#flash-data-success');

const alert = Swal.mixin({
    toast: true,
    position: 'top-end',
    icon: 'success',
    showConfirmButton: false,
    timer: 1500,
});

if (flash.getAttribute('data-flash-success') !== '') {
    alert.fire({
        icon: 'success',
        title: `${flash.getAttribute('data-flash-success')}`,
    });
}

const errorflash = document.querySelector('#flash-data-error');

const alerterror = Swal.mixin({
    toast: true,
    position: 'top-end',
    icon: 'error',
    showConfirmButton: false,
    timer: 1500,
});

if (errorflash.getAttribute('data-flash-error') !== '') {
    alerterror.fire({
        icon: 'error',
        title: `${flash.getAttribute('data-flash-error')}`,
    });
}
