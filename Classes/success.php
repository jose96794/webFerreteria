<?php

class Success{
    //ERROR|SUCCESS
    //Controller
    //method
    //operation
    
    const SUCCESS_ADMIN_NEWUSER     = "f52228665c4f14c8695b194f670b0ef1";
    const SUCCESS_EXPENSES_DELETE       = "fcd919285d5759328b143801573ec47d";
    const SUCCESS_EXPENSES_NEWEXPENSE   = "fbbd0f23184e820e1df466abe6102955";
    const SUCCESS_USER_UPDATEDATOS     = "2ee085ac8828407f4908e4d134195e5c";
    const SUCCESS_USER_UPDATENAME       = "6fb34a5e4118fb823636ca24a1d21669";
    const SUCCESS_USER_UPDATEPASSWORD       = "6fb34a5e4118fb823636ca24a1d21669";
    const SUCCESS_USER_UPDATEPHOTO       = "edabc9e4581fee3f0056fff4685ee9a8";
    const SUCCESS_SIGNUP_NEWUSER       = "8281e04ed52ccfc13820d0f6acb0985a";

    const SUCCESS_PRODUCT_UPDATEPHOTO = "8fc5692cfd8a119c5c102207cbfdcde8";
    const SUCCESS_SIGNUP_NEWPRODUCT = "058511c88c073a0adf1fb3d67529c0c9";
    const SUCCESS_ADMIN_NEWCATEGORY = "7085d129f6bae935bc430885bbf2a25e";
    
    const SUCCESS_CLIENTE_NEWUSER = "2be8ec3653049b96e4faaf9b058050af";

    const SUCCESS_ADMIN_DELETEUSER = "be76225b21ae9972f5ea1bbc805eb348";
    
    private $successList = [];

    public function __construct()
    {
        $this->successList = [
            Success::SUCCESS_ADMIN_NEWUSER => "Nuevo usuario creado correctamente",
            Success::SUCCESS_EXPENSES_DELETE => "Gasto eliminado correctamente",
            Success::SUCCESS_EXPENSES_NEWEXPENSE => "Nuevo gasto registrado correctamente",
            Success::SUCCESS_USER_UPDATEDATOS => "Datos personales actualizados correctamente",
            Success::SUCCESS_USER_UPDATEPASSWORD => "Contraseña actualizado correctamente",
            Success::SUCCESS_USER_UPDATEPHOTO => "Imagen de usuario actualizada correctamente",
            Success::SUCCESS_SIGNUP_NEWUSER => "Usuario registrado correctamente",

            Success::SUCCESS_PRODUCT_UPDATEPHOTO => "Imagen de producto actualizada correctamente",
            Success::SUCCESS_SIGNUP_NEWPRODUCT => "Producto registrado correctamente",
            Success::SUCCESS_ADMIN_NEWCATEGORY => "Categoria registrada correctamente",

            Success::SUCCESS_CLIENTE_NEWUSER => "Cliente / Proveedor registrado correctamente",

            Success::SUCCESS_ADMIN_DELETEUSER => "Usuario eliminado correctamente",
        ];
    }

    function get($hash){
        return $this->successList[$hash];
    }

    function existsKey($key){
        if(array_key_exists($key, $this->successList)){
            return true;
        }else{
            return false;
        }
    }
}
?>