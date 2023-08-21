function formatMataUang(angka) {
    // Menggunakan fungsi toLocaleString dengan opsi minimumFractionDigits untuk menghilangkan angka dibelakang koma
    return angka.toLocaleString('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 });
}

function diskonTigaBulanPremium(dis){
    const hargaPerBulan = document.getElementById("hargaPremium").value;
    const hargaTigaBulan = hargaPerBulan*3;
    if(dis != "" && dis > 0){
        const potonganHarga = hargaTigaBulan*(dis/100);
        const totalHarga = hargaTigaBulan-potonganHarga;
        document.getElementById("PremiumHarga3").textContent = formatMataUang(totalHarga);
    }else{
        document.getElementById("PremiumHarga3").textContent = formatMataUang(hargaTigaBulan);
    }
}
function diskonTigaBulanBusiness(dis){
    const hargaPerBulan = document.getElementById("hargaBusiness").value;
    const hargaTigaBulan = hargaPerBulan*3;
    if(dis != "" && dis > 0){
        const potonganHarga = hargaTigaBulan*(dis/100);
        const totalHarga = hargaTigaBulan-potonganHarga;
        document.getElementById("BusinessHarga3").textContent = formatMataUang(totalHarga);
    }else{
        document.getElementById("BusinessHarga3").textContent = formatMataUang(hargaTigaBulan);
    }
}
function diskonEnamBulanPremium(dis){
    const hargaPerBulan = document.getElementById("hargaPremium").value;
    const hargaEnamBulan = hargaPerBulan*6;
    if(dis != "" && dis > 0){
        const potonganHarga = hargaEnamBulan*(dis/100);
        const totalHarga = hargaEnamBulan-potonganHarga;
        document.getElementById("PremiumHarga6").textContent = formatMataUang(totalHarga);
    }else{
        document.getElementById("PremiumHarga6").textContent = formatMataUang(hargaEnamBulan);
    }
}
function diskonEnamBulanBusiness(dis){
    const hargaPerBulan = document.getElementById("hargaBusiness").value;
    const hargaEnamBulan = hargaPerBulan*6;
    if(dis != "" && dis > 0){
        const potonganHarga = hargaEnamBulan*(dis/100);
        const totalHarga = hargaEnamBulan-potonganHarga;
        document.getElementById("BusinessHarga6").textContent = formatMataUang(totalHarga);
    }else{
        document.getElementById("BusinessHarga6").textContent = formatMataUang(hargaEnamBulan);
    }
}
function diskonDuaBelasBulanPremium(dis){
    const hargaPerBulan = document.getElementById("hargaPremium").value;
    const hargaDuaBelasBulan = hargaPerBulan*12;
    if(dis != "" && dis > 0){
        const potonganHarga = hargaDuaBelasBulan*(dis/100);
        const totalHarga = hargaDuaBelasBulan-potonganHarga;
        document.getElementById("PremiumHarga12").textContent = formatMataUang(totalHarga);
    }else{
        document.getElementById("PremiumHarga12").textContent = formatMataUang(hargaDuaBelasBulan);
    }
}
function diskonDuaBelasBulanBusiness(dis){
    const hargaPerBulan = document.getElementById("hargaBusiness").value;
    const hargaDuaBelasBulan = hargaPerBulan*12;
    if(dis != "" && dis > 0){
        const potonganHarga = hargaDuaBelasBulan*(dis/100);
        const totalHarga = hargaDuaBelasBulan-potonganHarga;
        document.getElementById("BusinessHarga12").textContent = formatMataUang(totalHarga);
    }else{
        document.getElementById("BusinessHarga12").textContent = formatMataUang(hargaDuaBelasBulan);
    }
}
function diskonDuaPuluhEmpatBulanPremium(dis){
    const hargaPerBulan = document.getElementById("hargaPremium").value;
    const hargaDuaPuluhEmpatBulan = hargaPerBulan*24;
    if(dis != "" && dis > 0){
        const potonganHarga = hargaDuaPuluhEmpatBulan*(dis/100);
        const totalHarga = hargaDuaPuluhEmpatBulan-potonganHarga;
        document.getElementById("PremiumHarga24").textContent = formatMataUang(totalHarga);
    }else{
        document.getElementById("PremiumHarga24").textContent = formatMataUang(hargaDuaPuluhEmpatBulan);
    }
}
function diskonDuaPuluhEmpatBulanBusiness(dis){
    const hargaPerBulan = document.getElementById("hargaBusiness").value;
    const hargaDuaPuluhEmpatBulan = hargaPerBulan*24;
    if(dis != "" && dis > 0){
        const potonganHarga = hargaDuaPuluhEmpatBulan*(dis/100);
        const totalHarga = hargaDuaPuluhEmpatBulan-potonganHarga;
        document.getElementById("BusinessHarga24").textContent = formatMataUang(totalHarga);
    }else{
        document.getElementById("BusinessHarga24").textContent = formatMataUang(hargaDuaPuluhEmpatBulan);
    }
}