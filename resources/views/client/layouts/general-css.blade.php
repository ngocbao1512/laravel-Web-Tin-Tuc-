<style>
.tm-main {
    min-width: 80vw;
    margin-left: 0;
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