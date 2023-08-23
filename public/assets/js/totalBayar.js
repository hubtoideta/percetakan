function formatMataUang(angka) {
    // Menggunakan fungsi toLocaleString dengan opsi minimumFractionDigits untuk menghilangkan angka dibelakang koma
    return angka.toLocaleString('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 });
}
function sebulanBulan(bln){
    const hargaNormal = document.getElementById("hargaNormal").value;
    const hargaPaket = hargaNormal*bln;
    const diskonPaket = 0;
    const potonganHargaPaket = 0;
    const ppn = hargaPaket*0.11;
    const total = hargaPaket+ppn;

    document.getElementById("totalBulan").textContent = bln + " Bulan";
    document.getElementById("Harga").textContent = formatMataUang(hargaPaket).replace(/\s/g, '');
    document.getElementById("persen").textContent = "Diskon Paket -" + diskonPaket + "%";
    document.getElementById("potongan").textContent = "-" + formatMataUang(potonganHargaPaket).replace(/\s/g, '');
    document.getElementById("ppn").textContent = formatMataUang(ppn).replace(/\s/g, '');
    document.getElementById("total").textContent = formatMataUang(total).replace(/\s/g, '');
    // alert(hargaNormal)
}
function tigaBulan(bln){
    const hargaNormal = document.getElementById("hargaNormal").value;
    const hargaPaket = hargaNormal*bln;
    const diskonPaket = document.getElementById("diskonTigaBulan").value;
    const potonganHargaPaket = hargaPaket*(diskonPaket/100);
    const hargaDiskon = Math.round(hargaPaket-potonganHargaPaket);
    const ppn = Math.round(hargaDiskon*0.11);
    const total = hargaDiskon+ppn;

    document.getElementById("totalBulan").textContent = bln + " Bulan";
    document.getElementById("Harga").textContent = formatMataUang(hargaPaket).replace(/\s/g, '');
    document.getElementById("persen").textContent = "Diskon Paket -" + diskonPaket + "%";
    document.getElementById("potongan").textContent = "-" + formatMataUang(potonganHargaPaket).replace(/\s/g, '');
    document.getElementById("ppn").textContent = formatMataUang(ppn).replace(/\s/g, '');
    document.getElementById("total").textContent = formatMataUang(total).replace(/\s/g, '');
    // alert(hargaNormal)
}
function enamBulan(bln){
    const hargaNormal = document.getElementById("hargaNormal").value;
    const hargaPaket = hargaNormal*bln;
    const diskonPaket = document.getElementById("diskonEnamBulan").value;
    const potonganHargaPaket = hargaPaket*(diskonPaket/100);
    const hargaDiskon = Math.round(hargaPaket-potonganHargaPaket);
    const ppn = Math.round(hargaDiskon*0.11);
    const total = hargaDiskon+ppn;

    document.getElementById("totalBulan").textContent = bln + " Bulan";
    document.getElementById("Harga").textContent = formatMataUang(hargaPaket).replace(/\s/g, '');
    document.getElementById("persen").textContent = "Diskon Paket -" + diskonPaket + "%";
    document.getElementById("potongan").textContent = "-" + formatMataUang(potonganHargaPaket).replace(/\s/g, '');
    document.getElementById("ppn").textContent = formatMataUang(ppn).replace(/\s/g, '');
    document.getElementById("total").textContent = formatMataUang(total).replace(/\s/g, '');
    // alert(hargaNormal)
}
function duaBelasBulan(bln){
    const hargaNormal = document.getElementById("hargaNormal").value;
    const hargaPaket = hargaNormal*bln;
    const diskonPaket = document.getElementById("diskonDuaBelasBulan").value;
    const potonganHargaPaket = hargaPaket*(diskonPaket/100);
    const hargaDiskon = Math.round(hargaPaket-potonganHargaPaket);
    const ppn = Math.round(hargaDiskon*0.11);
    const total = hargaDiskon+ppn;

    document.getElementById("totalBulan").textContent = bln + " Bulan";
    document.getElementById("Harga").textContent = formatMataUang(hargaPaket).replace(/\s/g, '');
    document.getElementById("persen").textContent = "Diskon Paket -" + diskonPaket + "%";
    document.getElementById("potongan").textContent = "-" + formatMataUang(potonganHargaPaket).replace(/\s/g, '');
    document.getElementById("ppn").textContent = formatMataUang(ppn).replace(/\s/g, '');
    document.getElementById("total").textContent = formatMataUang(total).replace(/\s/g, '');
    // alert(hargaNormal)
}
function duaPuluhEmpatBulan(bln){
    const hargaNormal = document.getElementById("hargaNormal").value;
    const hargaPaket = hargaNormal*bln;
    const diskonPaket = document.getElementById("diskonDuaPuluhEmpatBulan").value;
    const potonganHargaPaket = hargaPaket*(diskonPaket/100);
    const hargaDiskon = Math.round(hargaPaket-potonganHargaPaket);
    const ppn = Math.round(hargaDiskon*0.11);
    const total = hargaDiskon+ppn;

    document.getElementById("totalBulan").textContent = bln + " Bulan";
    document.getElementById("Harga").textContent = formatMataUang(hargaPaket).replace(/\s/g, '');
    document.getElementById("persen").textContent = "Diskon Paket -" + diskonPaket + "%";
    document.getElementById("potongan").textContent = "-" + formatMataUang(potonganHargaPaket).replace(/\s/g, '');
    document.getElementById("ppn").textContent = formatMataUang(ppn).replace(/\s/g, '');
    document.getElementById("total").textContent = formatMataUang(total).replace(/\s/g, '');
    // alert(hargaNormal)
}