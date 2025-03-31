<?php

if (isset($_GET['ret'])) {
    $ret = $_GET['ret'];
}

if (isset($ret)) {


    switch ($ret) {
        case 0:
            echo '<div class="alert alert-warning">
                 Preencher o(os) campo(s) orbigatorio(s).
                 </div>';
            break;
        case 1:
            echo '<div class="alert alert-success">
                Ação realizada com sucesso.
               </div>';
            break;
        case -1:
            echo '<div class="alert alert-danger">
                  Ocorreu um erro na operação. Tente mais Tarde!
                  </div>';
            break;
        case -2:
            echo '<div class="alert alert-danger">
                     A senha deve conter no minimo 6 caracteres!
                      </div>';
            break;
        case -3:
            echo '<div class="alert alert-danger">
                         A senhas devem ser identicas!
                          </div>';
            break;

        case -3:
            echo '<div class="alert alert-danger">
                         A senhas devem ser identicas!
                          </div>';
            break;

        case -4:
            echo '<div class="alert alert-danger">
                             O registro não podera ser excluido, pois esta em uso!
                              </div>';
            break;

        case -5:
            echo '<div class="alert alert-danger">
                                 E-mail ja cadastrado. Coloque um outro e-mail!
                                  </div>';
            break;

            case -6:
                echo '<div class="alert alert-danger">
                                     Usuario não encontrado!
                                      </div>';
                break;
    }
}
