<?php

    class Productosmodel extends Model implements IModel{
        
        private $id;
        private $codigo;
        private $nombre;
        private $marca;
        private $precio_compra;
        private $precio_venta;
        private $ganancia;
        private $stock;
        private $imagen;
        //private $fecha;
        private $idcategoria;

        public function setId($id){ $this->id = $id; }
        public function setCodigo($codigo){ $this->codigo = $codigo; }
        public function setNombre($nombre){ $this->nombre = $nombre; }
        public function setMarca($marca){ $this->marca = $marca; }
        public function setPrecioCompra($precio_compra){ $this->precio_compra = $precio_compra; }
        public function setPrecioVenta($precio_venta){ $this->precio_venta = $precio_venta; }
        public function setGanancia($ganancia){ $this->ganancia = $ganancia; }
        public function setStock($stock){ $this->stock = $stock; }
        public function setImagen($imagen){ $this->imagen = $imagen; }
        //public function setFecha($fecha){ $this->fecha = $fecha; }
        public function setIdCategoria($idcategoria){ $this->idcategoria = $idcategoria; }

        public function getId(){ return $this->id; }
        public function getCodigo(){ return $this->codigo; }
        public function getNombre(){ return $this->nombre; }
        public function getMarca(){ return $this->marca; }
        public function getPrecioCompra(){ return $this->precio_compra; }
        public function getPrecioVenta(){ return $this->precio_venta; }
        public function getGanancia(){ return $this->ganancia; }
        public function getStock(){ return $this->stock; }
        public function getImagen(){ return $this->imagen; }
        //public function getFecha(){ return $this->fecha; }
        public function getIdCategoria(){ return $this->idcategoria; }
        
        public function __construct(){
            parent::__construct();
            
            //$this->codigo = '';
            //$this->nombre = '';
            //$this->marca = '';
            $this->precio_compra = 0.00;
            $this->precio_venta = 0.00;
            $this->ganancia = 0.00;
            $this->stock = 0;
            $this->idcategoria = 1;

            //$this->agregado = '';
        }

        public function save(){
            try{
                $query = $this->prepare('INSERT INTO productos (productos_codigo, productos_nombre, productos_marca, 
                productos_preccompra, productos_ganancia, productos_precventa, productos_cantidad, productos_imagen, productos_idcategorias) 
                VALUES (:productos_codigo, :productos_nombre, :productos_marca, :productos_preccompra, :productos_ganancia, 
                :productos_precventa, :productos_cantidad, :productos_imagen, :productos_idcategorias)');
                $query->execute([
                    'productos_codigo' => $this->codigo,
                    'productos_nombre' => $this->nombre,
                    'productos_marca' => $this->marca,
                    'productos_preccompra' => $this->precio_compra,
                    'productos_ganancia' => $this->ganancia,
                    'productos_precventa' => $this->precio_venta,
                    'productos_cantidad' => $this->stock,
                    'productos_imagen' => $this->imagen,
                    'productos_idcategorias' => $this->idcategoria

                ]);
                if($query->rowCount()) return true;

                return false;
            }catch(PDOException $e){
                return false;
            }
        }

        public function getAll(){
            $items = [];

            try{
                $query = $this->query('SELECT * FROM productos');
    
                while($p = $query->fetch(PDO::FETCH_ASSOC)){
                    $item = new Productosmodel();
                    $item->from($p); 
                    
                    array_push($items, $item);
                }
    
                return $items;
    
            }catch(PDOException $e){
                echo $e;
            }
        }

        public function get($id){
            try{
                $query = $this->prepare('SELECT * FROM productos WHERE productos_id = :productos_id');
                $query->execute([ 'productos_id' => $id]);
                $producto = $query->fetch(PDO::FETCH_ASSOC);

                $this->id = $producto['productos_id'];
                $this->codigo = $producto['productos_codigo'];
                $this->nombre = $producto['productos_nombre'];
                $this->marca = $producto['productos_marca'];
                $this->precio_compra = $producto['productos_preccompra'];
                $this->ganancia = $producto['productos_ganancia'];
                $this->precio_venta = $producto['productos_precventa'];
                $this->stock = $producto['productos_cantidad'];
                $this->imagen = $producto['productos_imagen'];
                $this->idcategoria = $producto['productos_idcategorias'];

                return $this;
            }catch(PDOException $e){
                return false;
            }
        }

        function updatePhoto($hash, $productos_id){
            try{
                $query = $this->db->connect()->prepare('UPDATE productos SET productos_imagen = :val WHERE productos_id = :productos_id');
                $query->execute(['val' => $hash, 'productos_id' => $productos_id]);
    
                if($query->rowCount() > 0){
                    return true;
                }else{
                    return false;
                }
            
            }catch(PDOException $e){
                return NULL;
            }
        }

        public function getcontarPorCategoria($productos_idcategorias){
            try{
                $query = $this->prepare('SELECT COUNT(*) FROM productos WHERE productos_idcategorias = :productos_idcategorias');
                $query->execute([ 'productos_idcategorias' => $productos_idcategorias]);
                $producto = $query->fetch(PDO::FETCH_ASSOC);

                return $producto['COUNT(*)'];
            }catch(PDOException $e){
                return false;
            }
        }

        public function getProductosBySearch($search){

            try{
                $query = $this->query('SELECT * FROM productos WHERE productos_nombre LIKE "%'.$search.'%" ORDER BY productos_nombre LIMIT 0,6');
    
                $data = $query->fetchAll(PDO::FETCH_ASSOC);

                return $data;
    
            }catch(PDOException $e){
                echo $e;
            }
        }

        public function delete($id){
            try{
                $query = $this->prepare('DELETE FROM productos WHERE productos_id = :productos_id');
                $query->execute([ 'productos_id' => $id]);
                return true;
            }catch(PDOException $e){
                echo $e;
                return false;
            }
        }

        public function update(){
            try{
                $query = $this->prepare('UPDATE productos SET productos_codigo = :productos_codigo, productos_nombre = :productos_nombre, 
                productos_marca = :productos_marca, productos_preccompra = :productos_preccompra, productos_ganancia = :productos_ganancia, 
                productos_precventa = :productos_precventa, productos_cantidad = :productos_cantidad, productos_imagen = :productos_imagen, 
                productos_idcategorias = :productos_idcategorias WHERE productos_id = :productos_id');
                $query->execute([
                    'productos_codigo' => $this->codigo,
                    'productos_nombre' => $this->nombre,
                    'productos_marca' => $this->marca,
                    'productos_preccompra' => $this->precio_compra,
                    'productos_ganancia' => $this->ganancia,
                    'productos_precventa' => $this->precio_venta,
                    'productos_cantidad' => $this->stock,
                    'productos_imagen' => $this->imagen,
                    'productos_idcategorias' => $this->idcategoria,
                    'productos_id' => $this->id
                ]);
                return true;

            }catch(PDOException $e){
                error_log('PRODUCTOSMODEL::update->PDOException ' . $e);
                return false;
            }
        }

        public function exists($codigo){
            try{
                $query = $this->prepare('SELECT productos_codigo FROM productos WHERE productos_codigo = :productos_codigo');
                $query->execute( ['productos_codigo' => $codigo]);
                
                if($query->rowCount() > 0){
                    return true;
                }else{
                    return false;
                }
            }catch(PDOException $e){
                echo $e;
                return false;
            }
        }

        public function existsID($id){
            try{
                $query = $this->prepare('SELECT productos_id FROM productos WHERE productos_id = :productos_id');
                $query->execute( ['productos_id' => $id]);
                
                if($query->rowCount() > 0){
                    return true;
                }else{
                    return false;
                }
            }catch(PDOException $e){
                echo $e;
                return false;
            }
        }

        public function from($array){
            $this->id = $array['productos_id'];
            $this->codigo = $array['productos_codigo'];
            $this->nombre = $array['productos_nombre'];
            $this->marca = $array['productos_marca'];
            $this->precio_compra = $array['productos_preccompra'];
            $this->precio_venta = $array['productos_precventa'];
            $this->stock = $array['productos_cantidad'];
            $this->imagen = $array['productos_imagen'];
            $this->idcategoria = $array['productos_idcategorias'];

        }
    }
?>