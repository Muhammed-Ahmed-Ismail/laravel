let sendAjax=(event) => {
    const params = {
        id: event.target.id
    }

    fetch("{{route('ajax.post')}}", {

        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        body: JSON.stringify(params)
    }).then(response => response.json())
        .then(data => { console.log(data)})
}
