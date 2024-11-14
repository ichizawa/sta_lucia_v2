<style>
    .overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background: rgba(0, 0, 0, 0.6);
        z-index: 9998;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.3s ease, visibility 0.3s ease;
    }

    .overlay.show {
        opacity: 1;
        visibility: visible;
    }

    .progr {
        animation: rotate 1s infinite;
        height: 50px;
        width: 50px;
        position: fixed;
        top: 40%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 9999;
    }

    .progr:before,
    .progr:after {
        border-radius: 50%;
        content: "";
        display: block;
        height: 20px;
        width: 20px;
    }

    .progr:before {
        animation: ball1 1s infinite;
        background-color: #fff;
        box-shadow: 30px 0 0 #fff;
        margin-bottom: 10px;
    }

    .progr:after {
        animation: ball2 1s infinite;
        background-color: #fff;
        box-shadow: 30px 0 0 #fff;
    }

    @keyframes rotate {
        0% {
            transform: rotate(0deg) scale(0.8)
        }

        50% {
            transform: rotate(360deg) scale(1.2)
        }

        100% {
            transform: rotate(720deg) scale(0.8)
        }
    }

    @keyframes ball1 {
        0% {
            box-shadow: 30px 0 0 #fff;
        }

        50% {
            box-shadow: 0 0 0 #fff;
            margin-bottom: 0;
            transform: translate(15px, 15px);
        }

        100% {
            box-shadow: 30px 0 0 #fff;
            margin-bottom: 10px;
        }
    }

    @keyframes ball2 {
        0% {
            box-shadow: 30px 0 0 #fff;
        }

        50% {
            box-shadow: 0 0 0 #fff;
            margin-top: -20px;
            transform: translate(15px, 15px);
        }

        100% {
            box-shadow: 30px 0 0 #fff;
            margin-top: 0;
        }
    }
</style>
<div class="overlay show">
    <span class="progr"></span>
</div>