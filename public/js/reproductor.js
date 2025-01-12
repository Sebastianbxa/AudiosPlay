       
document.addEventListener('DOMContentLoaded', function() {

    var audio_url_html = document.getElementById('audioUrl');
    var audio_url = audio_url_html.getAttribute('data-url');
    
    const audioPlayer = document.querySelector(".audio-player");
    const audio = new Audio(audio_url);
    
    // Intentar obtener la última posición guardada desde el almacenamiento local
    const lastPlayedTime = localStorage.getItem('lastPlayedTime');
    if (lastPlayedTime !== null) {
        audio.currentTime = parseFloat(lastPlayedTime);
    }
    
    audio.addEventListener(
        "loadeddata",
        () => {
            audioPlayer.querySelector(".time .length").textContent = getTimeCodeFromNum(
                audio.duration
            );
            audio.volume = .75;
        },
        false
    );
    
    //click on timeline to skip around
    const timeline = audioPlayer.querySelector(".timeline");
    timeline.addEventListener("click", e => {
        const timelineWidth = window.getComputedStyle(timeline).width;
        const timeToSeek = e.offsetX / parseInt(timelineWidth) * audio.duration;
        audio.currentTime = timeToSeek;
    }, false);
    
    //click volume slider to change volume
    const volumeSlider = audioPlayer.querySelector(".controls .volume-slider");
    volumeSlider.addEventListener('click', e => {
        const sliderWidth = window.getComputedStyle(volumeSlider).width;
        const newVolume = e.offsetX / parseInt(sliderWidth);
        audio.volume = newVolume;
        audioPlayer.querySelector(".controls .volume-percentage").style.width = newVolume * 100 + '%';
    }, false)
    
    //check audio percentage and update time accordingly
    setInterval(() => {
        const progressBar = audioPlayer.querySelector(".progress");
        progressBar.style.width = audio.currentTime / audio.duration * 100 + "%";
        audioPlayer.querySelector(".time .current").textContent = getTimeCodeFromNum(
            audio.currentTime
        );
    }, 500);
    
    //toggle between playing and pausing on button click
    const playBtn = audioPlayer.querySelector(".controls .toggle-play");
    playBtn.addEventListener(
        "click",
        () => {
            if (audio.paused) {
                playBtn.classList.remove("play");
                playBtn.classList.add("pause");
                audio.play();
            } else {
                playBtn.classList.remove("pause");
                playBtn.classList.add("play");
                audio.pause();
            }
        },
        false
    );
    
    // Save the current time when the window is unloaded
    window.addEventListener('beforeunload', () => {
        localStorage.setItem('lastPlayedTime', audio.currentTime.toString());
    });
    
    //turn 128 seconds into 2:08
    function getTimeCodeFromNum(num) {
        let seconds = parseInt(num);
        let minutes = parseInt(seconds / 60);
        seconds -= minutes * 60;
        const hours = parseInt(minutes / 60);
        minutes -= hours * 60;
    
        if (hours === 0) return `${minutes}:${String(seconds % 60).padStart(2, 0)}`;
        return `${String(hours).padStart(2, 0)}:${minutes}:${String(
            seconds % 60
        ).padStart(2, 0)}`;
    }
    
    





    

    //Reproductor C
    var audio_url_htmlC = document.getElementById('audioUrlC');
    var audio_urlC = audio_url_htmlC.getAttribute('data-url');

    const audioPlayerc = document.querySelector(".audio-playerc");
    const audioc = new Audio(audio_urlC);

    // Intentar obtener la última posición guardada desde el almacenamiento local
    const lastPlayedTimeC = localStorage.getItem('lastPlayedTimeC');
    if (lastPlayedTimeC !== null) {
        audioc.currentTime = parseFloat(lastPlayedTimeC);
    }

    audioc.addEventListener(
        "loadeddata",
        () => {
            audioPlayerc.querySelector(".timec .lengthc").textContent = getTimeCodeFromNum(
                audioc.duration
            );
            audioc.volume = .75;
        },
        false
    );

    //click on timeline to skip around
    const timelinec = audioPlayerc.querySelector(".timelinec");
    timelinec.addEventListener("click", e => {
        const timelineWidthc = window.getComputedStyle(timelinec).width;
        const timeToSeekc = e.offsetX / parseInt(timelineWidthc) * audioc.duration;
        audioc.currentTime = timeToSeekc;
    }, false);

    //click volume slider to change volume
    const volumeSliderc = audioPlayerc.querySelector(".controlsc .volume-sliderc");
    volumeSliderc.addEventListener('click', e => {
        const sliderWidthc = window.getComputedStyle(volumeSliderc).width;
        const newVolumec = e.offsetX / parseInt(sliderWidthc);
        audioc.volume = newVolumec;
        audioPlayerc.querySelector(".controlsc .volume-percentagec").style.width = newVolumec * 100 + '%';
    }, false)

    //check audio percentage and update time accordingly
    setInterval(() => {
        const progressBarc = audioPlayerc.querySelector(".progressc");
        progressBarc.style.width = audioc.currentTime / audioc.duration * 100 + "%";
        audioPlayerc.querySelector(".timec .currentc").textContent = getTimeCodeFromNum(
            audioc.currentTime
        );
    }, 500);

    //toggle cetween playing and pausing on cutton click
    const playBtnc = audioPlayerc.querySelector(".controlsc .toggle-playc");
    playBtnc.addEventListener(
        "click",
        () => {
            if (audioc.paused) {
                playBtnc.classList.remove("playc");
                playBtnc.classList.add("pause");
                audioc.play();
            } else {
                playBtnc.classList.remove("pause");
                playBtnc.classList.add("playc");
                audioc.pause();
            }
        },
        false
    );

    // Save the current time when the window is unloaded
    window.addEventListener('beforeunload', () => {
        localStorage.setItem('lastPlayedTimeC', audioc.currentTime.toString());
    });

    audioPlayerc.querySelector(".volume-cutton").addEventListener("click", () => {
        const volumeEl = audioPlayerc.querySelector(".volume-container .volume");
        audioc.muted = !audioc.muted;
        if (audioc.muted) {
            volumeEl.classList.remove("icono-volumeMedium");
            volumeEl.classList.add("icono-volumeMute");
        } else {
            volumeEl.classList.add("icono-volumeMedium");
            volumeEl.classList.remove("icono-volumeMute");
        }
    });

    //turn 128 seconds into 2:08
    function getTimeCodeFromNum(num) {
        let secondsc = parseInt(num);
        let minutesc = parseInt(secondsc / 60);
        secondsc -= minutesc * 60;
        const hoursc = parseInt(minutesc / 60);
        minutesc -= hoursc * 60;

        if (hoursc === 0) return `${minutesc}:${String(secondsc % 60).padStart(2, 0)}`;
        return `${String(hoursc).padStart(2, 0)}:${minutesc}:${String(
            secondsc % 60
        ).padStart(2, 0)}`;
    }




    
});

