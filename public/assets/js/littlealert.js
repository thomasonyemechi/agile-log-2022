function littleAlert(msg, t = 0) {
    color = (t == 1) ? 'danger' : 'success';
    icon = (t == 1) ? 'ban' : 'checked';
    ret = `
        <div id="refresh" class="alert bg-${color}" style="position:fixed; top:50px; right:15px; z-index:10000">
        <i class="icon fe fe-${color}  text-white"> ${msg}  </i>
        </div>
    `
    alat = $('.littleAlert');
    alat.fadeIn();
    alat.html(ret);

    setTimeout(function() {
        alat.fadeOut(1500);
    }, 3000);
}