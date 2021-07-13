const URL = document.getElementById('url').value;
const TOKEN = document.getElementById('token').value;

function getUpdate() {
    const elementUpdate = document.getElementsByClassName('update');

    for (let i = 0; i < elementUpdate.length; i++) {
        elementUpdate[i].addEventListener('click', function () {
            const id = this.getAttribute('data-id');
            document
                .getElementById('form-update')
                .setAttribute('action', URL + '/user/' + id);
            fetch(`${URL}/user/json/getUser/${id}`)
                .then(res => res.json())
                .then(res => {
                    document.querySelector('input[name=nama_user]').value =
                        res.data_update.nama_user;
                    document.querySelector(
                        'input[name=username]'
                    ).value = res.data_update.username;
                    document.querySelector('input[name=password]').value =
                        res.data_update.password;
                    document.querySelector('select[name=level]').value =
                        res.data_update.level;
                })
                .catch(err => console.log(err));
        });
    }
}

getUpdate();

document.getElementById('search').addEventListener('keyup', function () {
    const keyword = this.value;
    fetch(URL + '/user/group/search?name=' + keyword)
        .then(res => res.json())
        .then(res => {
            document.getElementById('list-data').innerHTML = parseSearch(res);
            getUpdate();
            listDelete();
        });
});

const parseSearch = data => {
    let html = '';
    data.data.map(res => {
        html += elementSearch(res);
    });
    return html;
};

const elementSearch = res => {
    let d = new Date(res.created_at);
    const date = `${d.getFullYear()}-${d.getMonth() + 1}-${d.getDate()}`;
    return /*html*/ `<tr>
    <td>${res.id_pemilik}</td>
    <td>${res.nama_pemilik}</td>
    <td>${res.register_pemilik}</td>
    <td>${res.nama_pemilik}</td>
    <td>${formatTanggal(date)}</td>
<td style="text-align: center;">

    <a href="#" class="btn btn-warning text-bold update"
        data-target="#modal-lg" data-toggle="modal"
        data-id="${res.id_pemilik
        }"><i class="fas fa-pencil-alt"></i>&nbsp;Ubah</a>
        <a href="/pemilik/${res.id_pemilik
        }" class="btn btn-danger text-bold delete"><i class="far fa-trash-alt"></i>&nbsp;Hapus</a>

</td>
</tr>`;
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