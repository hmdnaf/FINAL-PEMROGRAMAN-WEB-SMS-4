document.addEventListener('DOMContentLoaded', () => {
    const bookingForm = document.querySelector('form');

    if (bookingForm) {
        bookingForm.addEventListener('submit', function (e) {
            const fromCity = document.querySelector('select[name="from_city"]').value;
            const toCity = document.querySelector('select[name="to_city"]').value;
            const travelDate = document.querySelector('input[name="travel_date"]').value;

            // Validasi: kota asal dan tujuan tidak boleh sama
            if (fromCity === toCity) {
                alert("Kota asal dan tujuan tidak boleh sama!");
                e.preventDefault(); // hentikan pengiriman form
                return;
            }

            // Validasi: tanggal tidak boleh kosong
            if (!travelDate) {
                alert("Silakan pilih tanggal perjalanan.");
                e.preventDefault();
                return;
            }
        });
    }
});

const timeInput = document.querySelector('input[name="departure_time"]');
if (!timeInput.value) {
    alert("Silakan pilih jam keberangkatan.");
    e.preventDefault();
}

