let sendAjax = (event) => {
    const params = {
        id: event.target.id
    }

    fetch("/ajaxView", {

        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        body: JSON.stringify(params)
    }).then(response => response.json())
        .then(data => {
            console.log(data)
            let comments=data.comments
          let  commentCards=''
            for(const user in comments )
            {
                commentCards+=`
                    <div class="card mt-5">
                         <div class="card-header">
                                ${user}
                          </div>
                          <div class="card-body">
                               ${comments[user]}
                           </div>
                    </div>
                      `
            }
            $('.modal-body').html(`
            <div class="card mt-5">
        <div class="card-header">
            ${data.title}
        </div>
        <div class="card-body">
           ${data.post}
           ${commentCards}
        </div>

    </div>
            `)
            $('#exampleModal').modal('show')
        })
}
