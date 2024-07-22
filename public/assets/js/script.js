function formatRupiah(angka) {
    let reverse = angka.toString().split('').reverse().join('');
    let ribuan = reverse.match(/\d{1,3}/g);
    let hasil = ribuan.join('.').split('').reverse().join('');
    if (hasil.slice(-3) === '.00') {
        return hasil.slice(0, -3);
    } else {
        return hasil;
    }
}
