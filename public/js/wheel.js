var quayStatus = true;
var wheelAnimation = null;

function StartSpin() {
    if (!quayStatus) return;
    quayStatus = false;
    
    // Stop any existing animation
    if (wheelAnimation) {
        clearInterval(wheelAnimation);
    }

    $('#btnSpin').html('<i class="fa fa-spinner fa-spin"></i> Chờ kết quả...').prop('disabled', true);

    // Start spinning animation while waiting for response
    var rotateAngle = 0;
    wheelAnimation = setInterval(() => {
        rotateAngle += 5;
        document.getElementById("spin").style.transform = "rotate(" + rotateAngle + "deg)";
    }, 20);

    $.ajax({
        url: spinUrl,
        method: "POST",
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            if (response.status == 'error') {
                clearInterval(wheelAnimation);
                toastr.error(response.msg);
                $('#btnSpin').html('<i class="fas fa-play mr-1"></i>QUAY NGAY').prop('disabled', false);
                quayStatus = true;
                return false;
            }

            // Clear the initial spinning animation
            clearInterval(wheelAnimation);

            var audio = new Audio(baseUrl + "/audio/roulette.mp3");
            var audio1 = new Audio(baseUrl + "/audio/congratulation.mp3");
            var quayCount = $(".wheelText").length;
            var vp = 360 / quayCount;
            var targetPosition = response.location;

            audio.play();
            
            // Calculate final rotation
            var totalRotations = 3; // Number of full rotations before stopping
            var targetAngle = (360 * totalRotations) + (targetPosition * vp);
            var currentAngle = 0;
            var duration = 5000; // Animation duration in milliseconds
            var startTime = Date.now();
            
            function animate() {
                var elapsedTime = Date.now() - startTime;
                var progress = Math.min(elapsedTime / duration, 1);
                
                // Easing function for smooth deceleration
                var easeOut = 1 - Math.pow(1 - progress, 3);
                currentAngle = targetAngle * easeOut;
                
                document.getElementById("spin").style.transform = "rotate(" + currentAngle + "deg)";
                
                if (progress < 1) {
                    requestAnimationFrame(animate);
                } else {
                    // Animation complete
                    audio.pause();
                    audio1.play();
                    confetti();
                    toastr.success(response.msg);
                    
                    // Reset status after animation
                    setTimeout(() => {
                        $('#btnSpin').html('<i class="fas fa-play mr-1"></i>QUAY NGAY').prop('disabled', false);
                        quayStatus = true;
                        if(typeof spin_history_table !== 'undefined') {
                            spin_history_table.ajax.reload();
                        }
                    }, 1000);
                }
            }
            
            requestAnimationFrame(animate);
        },
        error: function() {
            clearInterval(wheelAnimation);
            toastr.error('Có lỗi xảy ra, vui lòng thử lại!');
            $('#btnSpin').html('<i class="fas fa-play mr-1"></i>QUAY NGAY').prop('disabled', false);
            quayStatus = true;
        }
    });
}