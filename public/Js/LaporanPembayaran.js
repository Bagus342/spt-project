const URL = document.getElementById('url').value;
const TOKEN = document.getElementById('token').value;

document.getElementById('filter').addEventListener('click', function () {
	filter();
});

function filter() {
	try {
		getfilter();
	} catch (e) {
		console.log(e);
		document.getElementById('list-data').innerHTML = 'error';
	}
}

function getfilter() {
	const pabrik = document.getElementById('pabrik').value;
	const type = document.getElementById('type').value;
	const date = document.getElementById('date-range').value;
	const split = date.split(' / ');
	const format = split[0].split('-')
	const format2 = split[1].split('-')
	const date1 = `${format[2]}-${format[1]}-${format[0]}`
	const date2 = `${format2[2]}-${format2[1]}-${format2[0]}`
	fetch(`${URL}/filterlaporan`, {
		method: 'post',
		body: JSON.stringify({
			tgl1: date1,
			tgl2: date2,
			type: type,
			tujuan: pabrik,
		}),
		headers: { 'Content-Type': 'application/json', 'X-CSRF-Token': TOKEN },
	})
		.then(res => res.json())
		.then(res => {
			document.getElementById('list-data').innerHTML = parse(res);
		});
}

const parse = data => {
	let html = '';
	let no = 1;
	data.data.map(res => {
		html += htmldata(res, no++);
	});
	return html;
};

const htmldata = (res, no) => {
	return /*html*/ `<tr>
	<td>${no}</td>
	<td>${res.no_invoice}</td>
	<td>${formatTanggal(res.tanggal_bayar)}</td>
	<td>${res.nama_sopir}</td>
	<td>${res.no_sp}</td>
	<td><a href="/pembayaran/str_replace('/', '-', ${res.no_invoice})" class="btn btn-danger text-bold"><i class="far fa-trash-alt"></i>&nbsp;Hapus</a></td>
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

const formatRupiah = (angka, prefix) => {
	var number_string = angka.replace(/[^,\d]/g, '').toString(),
		split = number_string.split(','),
		sisa = split[0].length % 3,
		rupiah = split[0].substr(0, sisa),
		ribuan = split[0].substr(sisa).match(/\d{3}/gi);

	// tambahkan titik jika yang di input sudah menjadi angka ribuan
	if (ribuan) {
		separator = sisa ? '.' : '';
		rupiah += separator + ribuan.join('.');
	}

	rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
	return prefix == undefined ? rupiah : rupiah ? 'Rp. ' + rupiah : '';
};
