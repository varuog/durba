<script>
console.log('foo');
$(document).ready(function() {
    console.log('bar');
    let title, type, typeIcon, content;
    $(".toast").each(function(index, element) {
        //console.log('element');
        title = $(element).data('title');
        subtitle = $(element).data('subtitle');
        type = $(element).data('type');
        content = $(element).text();

        typeIcon = 'fa-info';
        bgColor ='bg-info';
        /**
         * Handle error block
         */
        if(type == 'error') {
            typeIcon = 'fa-exclamation';
            bgColor ='bg-danger';

            if(!title) {
                title = 'Error Occured';
            }

            if(!subtitle) {
                subtitle = 'Error';
            }
        }

         /**
         * Handle warning block
         */
        if(type == 'warning') {
            typeIcon = 'fa-exclamation-triangle';
            bgColor ='bg-warning';

            if(!title) {
                title = 'Warning Occured';
            }

            if(!subtitle) {
                subtitle = 'Warning';
            }
        }


         /**
         * Handle info block
         */
        if(type == 'info') {
            typeIcon = 'fa-info';
            bgColor ='bg-info';

            if(!title) {
                title = 'More information';
            }

            if(!subtitle) {
                subtitle = 'Info';
            }
        }

         /**
         * Handle success block
         */
        if(type == 'success') {
            typeIcon = 'fa-check';
            bgColor ='bg-success';

            if(!title) {
                title = 'Successful operation';
            }

            if(!subtitle) {
                subtitle = 'Success';
            }
        }
        


        $(document).Toasts('create', {
        body: content,
        title: title,
        subtitle: subtitle,
        icon: "fas {typeIcon} fa-lg",
        delay: 5000,
        autohide: true,
        class: bgColor
      })

      $('.toast').on('created.lte.toast', function(ev) {
          console.log(ev)
      })
    });
   
});

</script>