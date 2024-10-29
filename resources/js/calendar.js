flatpickr("#calendar", {
    minDate: "{{ now()->format('Y-m-d') }}",
    maxDate: "{{ now()->addMonths(2)->format('Y-m-d') }}",
    inline: true,
    onDayCreate: function(dObj, dStr, fp, dayElem) {
        const dateStr = dayElem.dateObj.toISOString().split('T')[0];
        const dates = json($dates);

        // Custom coloring for available and fully booked dates
        if (dates[dateStr] === 'available') {
            dayElem.style.backgroundColor = theme === 'dark' ? '#2ECC71' : 'lightgreen';
            dayElem.style.color = 'white';
        } else if (dates[dateStr] === 'fully-booked') {
            dayElem.style.backgroundColor = theme === 'dark' ? '#E74C3C' : '#ff4d4d';
            dayElem.style.color = 'white';
        }
    }
});