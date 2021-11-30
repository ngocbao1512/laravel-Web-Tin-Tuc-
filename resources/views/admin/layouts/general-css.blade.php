<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

.modal-content {
    color : #39c9bf;
}



.container {
    position: sticky;
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    color: black;
    z-index: 10000;
}

.container .ring {
    position: relative;
    width: 150px;
    height: 150px;
    margin: -30px;
    border-radius: 50%;
    border: 4px solid transparent;
    border-top: 4px solid #24ecff;
    animation: beesLine 4s linear infinite;
}

@keyframes beesLine {
    0%
    {
        transform: rotate(0deg);
    }
    100%
    {
        transform:  rotate(360deg);
    }
}

.container .ring::before {
    content: "";
    position: absolute;
    top: 12px;
    right: 12px;
    border-radius: 50%;
    width: 15px;
    height: 15px;
    background: #24ecff;
    box-shadow: 0 0 0 5px #24ecff33,
    0 0 0 10px #24ecff22,
    0 0 0 20px #24ecff11,
    0 0 20px #24ecff,
    0 0 50px #24ecff;
}

.container .ring:nth-child(2) {
    animation: beesLine2 4s linear infinite;
    animation-delay: -1s;
    border-top: 4px solid transparent;
    border-left: 4px solid #93ff2d;
}

@keyframes beesLine2 {
    0%
    {
        transform: rotate(360deg);
    }
    100%
    {
        transform: rotate(0deg);
    }
}

.container .ring:nth-child(2)::before {
    content: "";
    position: absolute;
    top: initial;
    bottom: 12px;
    left: 12px;
    border-radius: 50%;
    width: 15px;
    height: 15px;
    background: #93ff2d;
    box-shadow: 0 0 0 5px #93ff2d33,
    0 0 0 10px #93ff2d22,
    0 0 0 20px #93ff2d11,
    0 0 20px #93ff2d,
    0 0 50px #93ff2d;
}

.container .ring:nth-child(3) {
    animation: beesLine2 4s linear infinite;
    animation-delay: -3s;
    position: absolute;
    top: -66.66px;
    border-top: 4px solid transparent;
    border-left: 4px solid #e41cf8;
}

.container .ring:nth-child(3)::before {
    content: "";
    position: absolute;
    top: initial;
    bottom: 12px;
    left: 12px;
    border-radius: 50%;
    width: 15px;
    height: 15px;
    background: #e41cf8;
    box-shadow: 0 0 0 5px #e41cf833,
    0 0 0 10px #e41cf822,
    0 0 0 20px #e41cf811,
    0 0 20px #e41cf8,
    0 0 50px #e41cf8;
}

.container p {
    position: absolute;
    color: black;
    font-size: 2.5em;
    font-family: monospace;
    bottom: -80px;
    letter-spacing: 0.15em;
}
#lang-switch img {
  width: 32px;
  height: 32px;
  opacity: 0.5;
  transition: all .5s;
  margin: auto 3px;
  -moz-user-select: none;
  -webkit-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

#lang-switch img:hover {
  cursor: pointer;
  opacity: 1;
}

.vn_lang,
.en_lang {
  display: none;
  transition: display .5s;
}

/* Language */
.active-lang {
  display: flex !important;
  transition: display .5s;
}

.active-flag {
  transition: all .5s;
  opacity: 1 !important;
}

.swal-height {
  height: 90vh;
}

</style>
