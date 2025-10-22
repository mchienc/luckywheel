class LuckyWheel {
    constructor(options = {}) {
        // Required elements
        this.wheel = document.getElementById(options.wheelId || 'spin');
        this.button = document.getElementById(options.buttonId || 'btnSpin');
        
        // Configuration
        this.spinEndpoint = options.spinEndpoint || '/spin';
        this.spinsCount = options.spinsCount || 3;
        this.spinDuration = options.spinDuration || 4000;
        
        // Audio setup
        this.sounds = {
            spin: new Audio(options.rouletteAudioPath || '/audio/roulette.mp3'),
            win: new Audio(options.winAudioPath || '/audio/congratulation.mp3')
        };

        // State
        this.isSpinning = false;
        this.currentSound = null;

        // Event binding
        this.button.addEventListener('click', () => this.spin());
        window.addEventListener('beforeunload', () => this.reset());
    }

    playSound(type) {
        if (this.currentSound) {
            this.currentSound.pause();
            this.currentSound.currentTime = 0;
        }
        this.currentSound = this.sounds[type];
        this.sounds[type].currentTime = 0;
        this.currentSound.play().catch(() => {
            // Ignore audio play errors
        });
    }

    stopSound() {
        if (this.currentSound) {
            this.currentSound.pause();
            this.currentSound.currentTime = 0;
            this.currentSound = null;
        }
    }

    reset() {
        this.isSpinning = false;
        this.wheel.style.transform = 'rotate(0deg)';
        this.button.disabled = false;
        this.button.innerHTML = '<i class="fas fa-play mr-1"></i>QUAY NGAY';
        this.stopSound();
    }

    async spin() {
        if (this.isSpinning) {
            toastr.warning('Vòng quay đang xử lý, vui lòng đợi!');
            return;
        }

        this.isSpinning = true;
        this.button.disabled = true;
        this.button.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Đang quay...';

        try {
            const response = await $.ajax({
                url: this.spinEndpoint,
                method: 'POST'
            });

            if (response.status === 'error') {
                throw new Error(response.msg);
            }

            // Calculate rotation
            const sliceCount = document.querySelectorAll('.wheelText').length;
            const degreesPerSlice = 360 / sliceCount;
            const targetDegrees = degreesPerSlice * response.location;
            const totalDegrees = (360 * this.spinsCount) + targetDegrees;
            
            // Start spinning animation
            this.playSound('spin');
            await this.animate(totalDegrees);
            
            // Show result
            this.stopSound();
            this.playSound('win');
            confetti();
            toastr.success(response.msg);

            // Reset after delay
            setTimeout(() => {
                this.reset();
                if (typeof spin_history_table !== 'undefined') {
                    spin_history_table.ajax.reload();
                }
            }, 1500);

        } catch (error) {
            toastr.error(error.message || 'Có lỗi xảy ra, vui lòng thử lại!');
            this.reset();
        }
    }

    animate(targetDegrees) {
        return new Promise((resolve) => {
            const startTime = performance.now();

            const tick = (currentTime) => {
                if (!this.isSpinning) {
                    resolve();
                    return;
                }

                const elapsed = currentTime - startTime;
                const progress = Math.min(elapsed / this.spinDuration, 1);

                // Smooth deceleration using cubic easing
                const easing = 1 - Math.pow(1 - progress, 3);
                const currentRotation = targetDegrees * easing;

                this.wheel.style.transform = `rotate(${-currentRotation}deg)`;

                if (progress < 1) {
                    requestAnimationFrame(tick);
                } else {
                    resolve();
                }
            };

            requestAnimationFrame(tick);
        });
    }
}