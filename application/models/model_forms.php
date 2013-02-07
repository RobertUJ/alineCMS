<?php

class Model_forms extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function convertir_mysql($fecha = ""){
        if($fecha == "") return "";
        $myfecha = explode("/", $fecha);
        $myotraFecha = $myfecha[2] . "-" . $myfecha[1] ."-". $myfecha[0];
        return $myotraFecha; 
    }
    public function guarda_form_uno(){
        $strId = $this->session->userdata('id');
        $fecha = date('Y-m-d');
        $data = array();
        // constantes para cada formulario 
        $data['folio'] = $this->input->post('folio',TRUE);
        $data['id_usuario'] = $strId;
    
        // Variables del formulario
        $data['fecha'] = $this->convertir_mysql($this->input->post('fecha_cuestionario',TRUE));
        $data['lugar_de_aplicacion'] = $this->input->post('Lugar_de_aplicacion',TRUE);
        $data['institucion_que_lo_aplica'] = $this->input->post('Institucion_que_lo_aplica',TRUE);
        $data['fecha_nacimiento'] = $this->convertir_mysql($this->input->post('Fecha_de_nacimiento',TRUE));
        $data['edad'] = $this->input->post('Edad',TRUE);
        $data['sexo'] = $this->input->post('Sexo',TRUE);
        $data['lugar_de_origen'] = $this->input->post('Lugar_de_origen',TRUE);
        $data['estado_civil'] = $this->input->post('Estado_Civil',TRUE);
        $data['estado_civil_otra'] = $this->input->post('Estado_Civil_Otra',TRUE);
        $data['numero_de_hijos'] = $this->input->post('Numero_de_hijos',TRUE);
        $data['edades_de_hijos'] = $this->input->post('Numero_de_hijos',TRUE);
        $data['nacionalidad_de_los_hijos'] = $this->input->post('Nacionalidad_de_los_hijos',TRUE);
        $data['sabe_leer_y_escribir'] = $this->input->post('Sabe_leer_y_escribir',TRUE);
        $data['ultimo_grado_escolar'] = $this->input->post('Ultimo_grado_escolar',TRUE);
        $data['tecnica'] = $this->input->post('Escribir_Ultimo_grado_escolar',TRUE);
        $data['idioma'] = $this->input->post('Idioma',TRUE);
        $data['idioma_otro'] = $this->input->post('Escribir_otro_idioma',TRUE);
        $data['profesa_alguna_religion'] = $this->input->post('Profesa_alguna_religion',TRUE);
        
        // Verifica si existe registro con clave unica en folio y fecha
        try {
            $this->db->where('folio', $data['folio']);
            $query_existe = $this->db->get('form_uno');
            if($query_existe->num_rows() > 0) {
                $this->db->where('folio', $data['folio']);
                $this->db->update('form_uno', $data); 
            }else{
                $this->db->insert('form_uno', $data); 
            }
            return TRUE;
        } catch (Exception $e) {
            return FALSE;
        }
    } // Fin Guarda Form1


    public function guarda_form_dos(){
        $strId = $this->session->userdata('id');
        $fecha = date('Y-m-d');
        $data = array();
        // constantes para cada formulario 
        $data['folio'] = $this->input->post('folio',TRUE);
        $data['id_usuario'] = $strId;
        $data['fecha'] = date("Y-m-d");
    
        // Variables del formulario
        $data['motivos_para_migrar'] = $this->input->post('Motivos_para_migrar',TRUE);
        $data['motivos_para_migrar_persecucion'] = $this->input->post('Motivos_para_migrar_Persecucion',TRUE);
        $data['motivos_para_migrar_otro'] = $this->input->post('Motivos_para_migrar_Otro',TRUE);
        $data['ultima_vez_salio_lugar_origen'] = $this->convertir_mysql($this->input->post('Cuando_fue_la_ultima_vez_que_salio_de_su_lugar_de_origen',TRUE));
        $data['destino_final'] = $this->input->post('Cual_fue_su_destino_final',TRUE);
        $data['destino_final_estado'] = $this->input->post('Otro_destino',TRUE);
        $data['veces_migrado'] = $this->input->post('Cuantas_veces_ha_migrado_intentado_migrar',TRUE);
        $data['salio_del_pais_solo_o_acompanado'] = $this->input->post('Cuando_salio_del_pais_fue_solo_o_acompanado',TRUE);
        $data['quien_lo_acompanaba'] = $this->input->post('Quien_lo_acompanaba_cuando_salio',TRUE);
        $data['quien_lo_acompanaba_otro'] = $this->input->post('Otro_acompanante',TRUE);
        $data['cuando_ingreso_a_mexico'] = $this->convertir_mysql($this->input->post('Cuando_ingreso_a_Mexico',TRUE));
        $data['por_donde_ingreso_a_mexico_estado'] = $this->input->post('estado',TRUE);
        $data['por_donde_ingreso_a_mexico_municipio'] = $this->input->post('ciudad',TRUE);
        $data['como_ingreso_a_mexico'] = $this->input->post('Como_ingreso_a_Mexico',TRUE);
        $data['que_documento_traia'] = $this->input->post('Al_ingresar_a_Mexico_que_documento_traia',TRUE);
        $data['otro_documento'] = $this->input->post('Otro_documento',TRUE);
        $data['actualmente_cuenta_con_este_documento'] = $this->input->post('Actualmente_cuenta_con_este_documento',TRUE);
        $data['por_que_cuenta_con_este_documento'] = $this->input->post('por_quey',TRUE);
        $data['sufrio_agresiones_fisicas'] = $this->input->post('Durante_el_viaje_a_Mexico_sufrio_agresiones_fisicas',TRUE);
        $data['que_tipo_de_agresiones_fisicas'] = $this->input->post('de_que_tipo',TRUE);
        $data['sufrio_agresiones_verbales_o_psicologicas'] = $this->input->post('Durante_el_viaje_a_Mexico_sufrio_agresiones_verbales_o_psicologicas',TRUE);
        $data['que_tipo_de_agresiones_verbales_psicologicas'] = $this->input->post('de_que_tipo_',TRUE);
        $data['responsable_de_estas_agresiones'] = $this->input->post('Recuerda_quien_fue_responsable_de_esta_agresion',TRUE);
        $data['denuncio_estos_hechos'] = $this->input->post('Denuncio_estos_hechos',TRUE);
        $data['denuncio_estos_hechos_institucion'] = $this->input->post('Ante_que_institucion',TRUE);
        $data['por_que_no_denuncio_estos_hechos'] = $this->input->post('En_caso_de_que_no_por_que_no',TRUE);
        $data['por_que_no_denuncio_estos_hechos_otro'] = $this->input->post('Otro_motivo',TRUE);
        // Verifica si existe registro con clave unica en folio y fecha
        try {
            $this->db->where('folio', $data['folio']);
            $query_existe = $this->db->get('form_dos');
            if($query_existe->num_rows() > 0) {
                $this->db->where('folio', $data['folio']);
                $this->db->update('form_dos', $data); 
            }else{
                $this->db->insert('form_dos', $data); 
            }
            return TRUE;
        } catch (Exception $e) {
            return FALSE;
        }
    }// Guarda Form dos

    public function guarda_form_tres(){
        $strId = $this->session->userdata('id');
        $fecha = date('Y-m-d');
        $data = array();
        // constantes para cada formulario 
        $data['folio'] = $this->input->post('folio',TRUE);
        $data['id_usuario'] = $strId;
        $data['fecha'] = date("Y-m-d");
    
        // Variables del formulario
        $data['sufrio_algun_tipo_violacio_a_derechos'] = $this->input->post('Durante_su_paso_por_Mexico_sufrio_algun_tipo_de_abuso_o_violacion_a_sus_derechos',TRUE);
        $data['sufrio_algun_tipo_violacion_derechos_tipo'] = $this->input->post('Que_tipo_de_abuso_o_violacion',TRUE);
        $data['fecha_de_hechos'] = $this->convertir_mysql($this->input->post('Fecha_en_la_que_ocurrieron_los_hechos',TRUE));
        $data['lugar_de_hechos'] = $this->input->post('Lugar_donde_ocurrieron_los_hechos',TRUE);
        $data['hora_de_hechos'] = $this->input->post('hora',TRUE) . ":" . $this->input->post('hora',TRUE) ;

        $data['hubo_uso_armas'] = $this->input->post('Hubo_uso_de_armas',TRUE);
        $data['Que_tipo_de_arma_fuego'] = $this->input->post('Que_tipo_de_arma_fuego',TRUE);
        $data['hubo_privacion_libertad'] = $this->input->post('Hubo_privacion_de_la_libertad',TRUE);
        $data['donde_permanecio_detenido'] = $this->input->post('Si_si_donde_permanecio_detenido',TRUE);
        $data['donde_permanecio_detenido'] = $this->input->post('Si_si_donde_permanecio_detenido',TRUE);
        // ******************************************
        // Ejemplo para recoger varibles multiples tipo array
        $data['que_se_solicito_para_libertad'] = $this->get_cadena($this->input->post('Que_se_le_solicito_para_otorgarle_su_libertad',TRUE));
        // ******************************************
        $data['que_se_solicito_para_libertad_a'] = $this->input->post('cantidad_dinero',TRUE);
        $data['que_se_solicito_para_libertad_b'] = $this->input->post('Tareas_o_faenas',TRUE);
        $data['que_se_solicito_para_libertad_c'] = $this->input->post('Otro',TRUE);
        $data['autoridad_responsable'] = $this->input->post('autoridad_responsable',TRUE);
        $data['denuncio_hechos'] = $this->input->post('Denuncio_estos_hechos',TRUE);
        $data['denuncio_hechos_instancia'] = $this->input->post('Instancia_donde_denuncio',TRUE);
        $data['por_que_no_denuncio_hechos'] = $this->input->post('En_caso_de_que_no_por_que_no',TRUE);
        $data['por_que_no_denuncio_hechos_otro'] = $this->input->post('por_que_no',TRUE);
        // Verifica si existe registro con clave unica en folio y fecha
        try {
            $this->db->where('folio', $data['folio']);
            $query_existe = $this->db->get('form_tres');
            if($query_existe->num_rows() > 0) {
                $this->db->where('folio', $data['folio']);
                $this->db->update('form_tres', $data); 
            }else{
                $this->db->insert('form_tres', $data); 
            }
            return TRUE;
        } catch (Exception $e) {
            return FALSE;
        }
    }// Guarda Form tres

    public function guarda_form_cuatro(){
        $strId = $this->session->userdata('id');
        $fecha = date('Y-m-d');
        $data = array();
        // constantes para cada formulario 
        $data['folio'] = $this->input->post('folio',TRUE);
        $data['id_usuario'] = $strId;
         $data['fecha'] = date("Y-m-d");
    
        // Variables del formulario
        
        // fechas ->  $data['fecha_nacimiento'] = $this->convertir_mysql($this->input->post('Fecha_de_nacimiento',TRUE));
        $data['fecha_ultima_verificacion_migratoria'] = $this->convertir_mysql($this->input->post('Fecha_de_la_ultima_verificacion_migratoria',TRUE));
        $data['lugar_ultima_verificacion_migratoria_estado'] = $this->input->post('estado',TRUE);    
        $data['lugar_ultima_verificacion_migratoria_municipio'] = $this->input->post('ciudad',TRUE);
        $data['autoridad_verifico_situacion_migratoria'] = $this->input->post('Autoridad_que_verifico_la_situacion_migratoria',TRUE);
        $data['le_informaron_motivos_de_verificacion_migratoria'] = $this->input->post('Le_informaron_sobre_los_motivos_de_la_verificacion_migratoria',TRUE);
        $data['tiempo_para_llegar_a_estacion_migratoria_dias'] = $this->input->post('dias',TRUE);
        $data['tiempo_para_llegar_a_estacion_migratoria_horas'] = $this->input->post('Horas',TRUE);
        $data['le_informaron_motivos_tiempo_procedimiento_detencion'] = $this->input->post('Le_informaron_sobre_los_motivos_tiempo_y_procedimiento_de_su_detencion',TRUE);
        $data['le_agredieron_fisica_verbal_psicologica'] = $this->input->post('Durante_la_verificacion_migratoria_le_agredieron_fisica_psicologica_o_verbalmente',TRUE);
        $data['le_agredieron_fisica_verbal_psicologica_tipo'] = $this->input->post('Ingrese_el_tipo_de_agrecion',TRUE);
        $data['agresor'] = $this->input->post('Quien_fue_el_agresor',TRUE);
        $data['denuncio_estos_hechos'] = $this->input->post('Denuncio_estos_hechos',TRUE);
        $data['denuncio_estos_hechos_instancia'] = $this->input->post('Ingrese_la_instancia_donde_denuncio',TRUE);
        $data['denuncio_estos_hechos_por_que_no'] = $this->input->post('En_caso_de_que_no_por_que_no',TRUE);
        $data['denuncio_estos_hechos_por_que_no_otro'] = $this->input->post('Ingrese_otro_motivo',TRUE);
        // Verifica si existe registro con clave unica en folio y fecha
        try {
            $this->db->where('folio', $data['folio']);
            $query_existe = $this->db->get('form_cuatro');
            if($query_existe->num_rows() > 0) {
                $this->db->where('folio', $data['folio']);
                $this->db->update('form_cuatro', $data); 
            }else{
                $this->db->insert('form_cuatro', $data); 
            }
            return TRUE;
        } catch (Exception $e) {
            return FALSE;
        }
    } // Fin Guarda Cuatro



    public function guarda_form_cinco(){
        $strId = $this->session->userdata('id');
        $fecha = date('Y-m-d');
        $data = array();
        // constantes para cada formulario 
        $data['folio'] = $this->input->post('folio',TRUE);
        $data['id_usuario'] = $strId;
        $data['fecha'] = date("Y-m-d");
         // Variables del formulario
        // fechas ->  $data['fecha_nacimiento'] = $this->convertir_mysql($this->input->post('Fecha_de_nacimiento',TRUE));
        $data['le_informaron_motivos_tiempo_proced_de_detencion'] = $this->input->post('Le_informaron_sobre_los_motivos_tiempo_y_procedimiento_de_su_detencion',TRUE);    
        $data['firmo_algun_documento'] = $this->input->post('Firmo_algun_documento',TRUE);
        $data['firmo_algun_documento_tipo'] = $this->input->post('De_que_tipo',TRUE);
        $data['coloco_huellas_digitales'] = $this->input->post('Coloco_sus_huellas_digitales',TRUE);
        $data['le_tomaron_fotografias'] = $this->input->post('Le_tomaron_fotografias',TRUE);
        $data['tuvo_contacto_con_consulado'] = $this->input->post('Tuvo_contacto_con_su_consulado',TRUE);
        $data['tuvo_contacto_con_abogado'] = $this->input->post('Tuvo_contacto_con_un_abogado_o_persona_de_su_confianza',TRUE);
        $data['le_fue_presentado_falso_abogado'] = $this->input->post('Le_fue_presentado_un_falso_abogado',TRUE);
        $data['habia_cama_o_colchon'] = $this->input->post('Habia_cama_o_colchon_para_dormir_en_el_lugar',TRUE);
        $data['estado_de_cama_o_colchon'] = $this->input->post('Cual_era_el_estado_de_la_cama_o_colchon',TRUE);
        $data['estado_de_cama_o_colchon_otro'] = $this->input->post('otro_estado',TRUE);
        $data['le_proporcionaron_alimentos'] = $this->input->post('Le_proporcionaron_alimentos',TRUE);
        $data['caracteristicas_de_alimentos'] = $this->get_cadena($this->input->post('Caracteristicas_de_los_alimentos_se_puede_marcar_mas_de_una',TRUE));
        $data['caracteristicas_de_alimentos_otro'] = $this->input->post('otra_caracteristica',TRUE);
        $data['suficiente_agua_potable'] = $this->input->post('Le_proporcionaron_suficiente_agua_potable',TRUE);
        $data['se_facilito_agua_para_asearse'] = $this->input->post('Se_le_facilito_agua_para_asearse',TRUE);
        $data['se_facilito_agua_para_lavar_ropa'] = $this->input->post('Se_le_facilito_agua_para_lavar_su_ropa',TRUE);
        $data['acceso_a_servicios_medicos'] = $this->input->post('Tuvo_acceso_a_servicios_medicos',TRUE);
        $data['proporcionaron_enseres_aseo_personal'] = $this->input->post('Le_proporcionaron_enseres_de_aseo_personal',TRUE);
        $data['le_informaron_a_donde_se_dirigia'] = $this->input->post('Cuando_fue_trasladado_a_la_garita_o_punto_de_detencion_lugar_le_informaron_a_donde_se_dirigia',TRUE);
        $data['punto_detencion_agredido_fisica_psicologica_verbal'] = $this->input->post('Durante_su_estancia_en_la_garita_o_punto_de_detencion_fue_agredido_fisica_psicologica_o_verbalmente',TRUE);
        $data['punto_detencion_agredido_fisica_psicologica_verbal_tipo'] = $this->input->post('De_que_tipo',TRUE);
        $data['punto_detencion_agredido_fisica_psicologica_verbal_agresor'] = $this->input->post('Quien_fue_su_agresor',TRUE);
        $data['punto_detencion_agredido_fisica_psicologica_verbal_agresor_otro'] = $this->input->post('otro_agresor',TRUE);
        $data['denuncio_estos_hechos'] = $this->input->post('Denuncio_estos_hechos',TRUE);
        $data['denuncio_estos_hechos_por_que_no'] = $this->input->post('En_caso_de_que_no_Por_que_no',TRUE);
        $data['denuncio_estos_hechos_por_que_no_otro'] = $this->input->post('otro_por_que_no',TRUE);
        // Verifica si existe registro con clave unica en folio y fecha
        try {
            $this->db->where('folio', $data['folio']);
            $query_existe = $this->db->get('form_cinco');
            if($query_existe->num_rows() > 0) {
                $this->db->where('folio', $data['folio']);
                $this->db->update('form_cinco', $data); 
            }else{
                $this->db->insert('form_cinco', $data); 
            }
            return TRUE;
        } catch (Exception $e) {
            return FALSE;
        }
    } // Fin Guarda Cinco

    public function guarda_form_seis(){
        $strId = $this->session->userdata('id');
        $fecha = date('Y-m-d');
        $data = array();
        // constantes para cada formulario 
        $data['folio'] = $this->input->post('folio',TRUE);
        $data['id_usuario'] = $strId;
         $data['fecha'] = date("Y-m-d");
    
        // Variables del formulario
        
        // fechas ->  $data['fecha_nacimiento'] = $this->convertir_mysql($this->input->post('Fecha_de_nacimiento',TRUE));
        // multiple ->   $data['tabla_nombre'] = $this->get_cadena($this->input->post('form_nombre',TRUE));
        $data['veces_en_una_estacion_migratoria'] = $this->input->post('Numero_de_veces_que_ha_estado_en_una_estacion_migratoria',TRUE);    
        $data['ultima_estacion_migratoria_estado'] = $this->input->post('estado',TRUE);
        $data['ultima_estacion_migratoria_municipio'] = $this->input->post('ciudad',TRUE);
        $data['dias_en_la_ultima_estacion_migratoria'] = $this->input->post('Dias_que_permanecio_en_la_ultima_estacion_migratoria',TRUE);
        $data['ultima_estacion_migratoria_en_que_estuvo'] = $this->input->post('Cual_fue_la_ultima_estacion_migratoria_en_la_que_estuvo',TRUE);
        $data['informaron_sobre_sus_derechos'] = $this->input->post('Le_informaron_sobre_sus_derechos',TRUE);
        $data['le_informaron_motivos_tiempo_preced_de_detencion'] = $this->input->post('Le_informaron_sobre_los_motivos_tiempo_y_procedimiento_de_su_detencion',TRUE);
        $data['tuvo_acceso_informacion_derechos_proceso'] = $this->input->post('Tuvo_acceso_a_informacion_sobre_derechos_y_proceso_migratorio',TRUE);
        $data['informado_derecho_solicitar_asilo'] = $this->input->post('Le_fue_informado_sobre_su_derecho_a_solicitar_asilo',TRUE);
        $data['le_fue_preguntado_sufrio_alguna_violacion_derechos_humanos'] = $this->input->post('Le_fue_preguntado_su_sufrio_alguna_violacion_de_derechos_humanos',TRUE);
        $data['coloco_huellas_digitales'] = $this->input->post('Coloco_sus_huellas_digitales',TRUE);
        $data['le_tomaron_fotografias'] = $this->input->post('Le_tomaron_fotografias',TRUE);
        $data['firmo_algun_documento'] = $this->input->post('Firmo_algun_documento',TRUE);
        $data['firmo_algun_documento_tipo'] = $this->input->post('Que_tipo_de_documento',TRUE);
        $data['tuvo_contacto_con_consulado'] = $this->input->post('Tuvo_contacto_con_su_consulado',TRUE);
        $data['tuvo_contacto_con_consulado_negado'] = $this->input->post('En_caso_de_que_no_Lo_solicito_y_le_fue_negado_el_permiso',TRUE);
        $data['tuvo_contacto_con_asistencia_consular'] = $this->input->post('Tuvo_contacto_con_asistencia_consular_durante_todo_el_proceso',TRUE);
        $data['tuvo_contacnto_con_abogado'] = $this->input->post('Tuvo_contacto_con_un_abogado_o_una_persona_de_su_confianza',TRUE);
        $data['contacnto_con_abogado_negado'] = $this->input->post('En_caso_de_que_si_Lo_solicito_y_le_fue_negado_el_permiso',TRUE);
        $data['le_fue_presentado_falso_abogado'] = $this->input->post('Le_fue_presentado_un_falso_abogado',TRUE);
        $data['acceso_a_traductor_o_interprete'] = $this->input->post('Ha_tenido_acceso_a_un_traductor_o_interprete',TRUE);
        $data['acceso_a_traductor_o_interprete_por_que_no'] = $this->input->post('Si_la_respuesta_fue_no_Por_que',TRUE);
        $data['acceso_a_traductor_o_interprete_por_que_no_otro'] = $this->input->post('otro_porque',TRUE);
        $data['requiere_alimentos_especiales'] = $this->input->post('Requiere_o_requirio_alimentos_especiales',TRUE);
        $data['requiere_alimentos_especiales_por_que'] = $this->input->post('Si_si_por_que',TRUE);
        $data['le_fueron_proporcionados'] = $this->input->post('Le_fueron_proporcionados',TRUE);
        $data['caracteristicas_de_alimentos'] = $this->get_cadena($this->input->post('Caracteristicas_de_los_alimentos_se_puede_marcar_mas_de_una',TRUE));
        $data['proporcionaron_suficiente_agua_potable'] = $this->input->post('Le_proporcionaron_suficiente_agua_potable',TRUE);
        $data['se_facilito_agua_para_asearse'] = $this->input->post('Se_le_facilito_agua_para_asearse',TRUE);
        $data['se_facilito_agua_para_lavar_ropa'] = $this->input->post('Se_le_facilito_agua_para_lavar_su_ropa',TRUE);
        $data['requirio_atencion_medica_en_estacion_migratoria'] = $this->input->post('Requirio_o_ha_requerido_atencion_medica_durante_su_estancia_en_la_estacion_migratoria',TRUE);
        $data['medico_se_encontraba_siempre_en_estacion'] = $this->input->post('El_medico_se_encontraba_siempre_en_la_estacion_migratoria',TRUE);
        $data['medico_siempre_disponible'] = $this->input->post('El_medico_estaba_siempre_disponible',TRUE);
        $data['medico_era_respetuoso'] = $this->input->post('El_medico_estaba_siempre_disponible',TRUE);
        $data['medico_ponia_atencion_a_sintomas_explicaciones'] = $this->input->post('El_medico_ponia_atencion_a_sus_sintomas_y_explicaciones',TRUE);
        $data['diagnostico_y_medicacion_efectivos'] = $this->input->post('El_diagnostico_y_la_medicacion_fueron_efectivos',TRUE);
        $data['mujeres_informacion_cancer_de_mama_y_cervicouterino'] = $this->input->post('En_el_caso_de_mujeres_le_dieron_informacion_sobre_el_cancer_de_mama_y_cancer_cervicouterino',TRUE);
        $data['estaba_embarazada'] = $this->input->post('Estaba_embarazada_si_no_pasar_a_la_pregunta_39',TRUE);
        $data['se_proporcionaron_vitaminas_en_caso_de_embarazada'] = $this->input->post('Se_le_proporcionaron_vitaminas_en_caso_de_estar_embarazada',TRUE);
        $data['realizaron_ecografias_en_caso_embarazada'] = $this->input->post('Se_le_realizaron_ecografias_en_caso_de_estar_embarazada',TRUE);
        $data['cama_o_colchon_dormir_en_el_lugar'] = $this->input->post('Habia_cama_o_colchon_para_dormir_en_el_lugar',TRUE);
        $data['estado_de_cama_o_colchon'] = $this->input->post('Cual_era_el_estado_de_la_cama_o_colchon',TRUE);
        $data['estado_de_cama_o_colchon_otro'] = $this->input->post('otro_estado',TRUE);
        $data['hombres_y_mujeres_dormian_lugares_separados'] = $this->input->post('Los_hombres_y_las_mujeres_dormian_en_lugares_separados',TRUE);
        $data['proporcionaron_suficientes_enseres_de_aseo_personal'] = $this->input->post('Le_proporcionaron_suficientes_enseres_de_aseo_personal',TRUE);
        $data['podia_recibir_visitas'] = $this->input->post('Se_podian_recibir_visitas',TRUE);
        $data['medidas_disciplinarias_en_estacion_migratoria'] = $this->input->post('Existian_medidas_disciplinarias_en_la_estacion_migratoria',TRUE);
        $data['describir_medidas'] = $this->input->post('Describir',TRUE);
        $data['agredido_fisica_psicologica_verbal'] = $this->input->post('Durante_su_aseguramiento_fue_agredido_fisica_psicologica_o_verbalmente',TRUE);
        $data['agredido_fisica_psicologica_verbal_tipo'] = $this->input->post('De_que_tipo',TRUE);
        $data['agresor'] = $this->input->post('Quien_fue_su_agresor',TRUE);
        $data['agresor_otro'] = $this->input->post('otro_agresor',TRUE);
        $data['denuncio_hechos'] = $this->input->post('Denuncio_estos_hechos',TRUE);
        $data['denuncio_hechos_instancia'] = $this->input->post('si_instancia',TRUE);
        $data['denuncio_hechos_por_que_no'] = $this->input->post('En_caso_de_que_no_Por_que_no',TRUE);
        $data['denuncio_hechos_por_que_no_otro'] = $this->input->post('por_que_no',TRUE);
        
        // Verifica si existe registro con clave unica en folio y fecha
        try {
            $this->db->where('folio', $data['folio']);
            $query_existe = $this->db->get('form_seis');
            if($query_existe->num_rows() > 0) {
                $this->db->where('folio', $data['folio']);
                $this->db->update('form_seis', $data); 
            }else{
                $this->db->insert('form_seis', $data); 
            }
            return TRUE;
        } catch (Exception $e) {
            return FALSE;
        }
    } // Fin Guarda Form1

    public function guarda_form_siete(){
        $strId = $this->session->userdata('id');
        $fecha = date('Y-m-d');
        $data = array();
        // constantes para cada formulario 
        $data['folio'] = $this->input->post('folio',TRUE);
        $data['id_usuario'] = $strId;
        $data['fecha'] = date("Y-m-d");
        // Variables del formulario
        $data['folio_numero_de_expediente'] = $this->input->post('Folio_o_numero_de_expediente',TRUE);    
        $data['fecha_de_presentacion_de_la_denuncia'] = $this->convertir_mysql($this->input->post('Fecha_de_presentacion_de_la_denuncia',TRUE));
        $data['entidad_estado'] = $this->input->post('estado',TRUE);    
        $data['entidad_municipio'] = $this->input->post('ciudad',TRUE);   
        $data['instancia_ante_la_que_se_presento_la_denuncia'] = $this->input->post('Instancia_ante_la_que_se_presento_la_denuncia',TRUE);    
        $data['fecha_calificacion'] = $this->convertir_mysql($this->input->post('Fecha_de_la_calificacion',TRUE));    
        $data['tipo_de_denuncia'] = $this->input->post('Tipo_de_denuncia',TRUE);    
        $data['descripcion_de_los_hechos_denunciados'] = $this->input->post('Descripcion_de_los_hechos_denunciados',TRUE); 
        $data['descripcion_de_los_hechos_denunciados_donde'] = $this->input->post('donde',TRUE); 
        $data['hubo_propuesta_de_conciliacion'] = $this->input->post('Hubo_propuesta_de_conciliacion',TRUE);    
        $data['Requerimiento_al_INM'] = $this->input->post('Requerimiento_al_INM',TRUE);  
        $data['Respuesta_del_INM_a_la_conciliacion'] = $this->input->post('Respuesta_del_INM_a_la_conciliacion',TRUE);  
        $data['Requerimiento_hecho_a_otra_institucion'] = $this->input->post('Requerimiento_hecho_a_otra_institucion',TRUE);    
        $data['Recibio_asesoria_para_recibir_la_denuncia'] = $this->input->post('Recibio_asesoria_para_recibir_la_denuncia',TRUE);    
        $data['En_donde_recibio_esta_asesoria'] = $this->input->post('En_donde_recibio_esta_asesoria',TRUE);    
        $data['Ingrese_el_otro_lugar'] = $this->input->post('Ingrese_el_otro_lugar',TRUE);    
        // Verifica si existe registro con clave unica en folio y fecha
        try {
            $this->db->where('folio', $data['folio']);
            $query_existe = $this->db->get('form_siete');
            if($query_existe->num_rows() > 0) {
                $this->db->where('folio', $data['folio']);
                $this->db->update('form_siete', $data); 
            }else{
                $this->db->insert('form_siete', $data); 
            }
            return TRUE;
        } catch (Exception $e) {
            return FALSE;
        }
    } // Fin Guarda Cuatro

    public function guarda_form_ocho(){
        $strId = $this->session->userdata('id');
        $fecha = date('Y-m-d');
        $data = array();
        // constantes para cada formulario 
        $data['folio'] = $this->input->post('folio',TRUE);
        $data['id_usuario'] = $strId;
        $data['fecha'] = date("Y-m-d");
    
        // Variables del formulario
        $data['meses'] = $this->input->post('Mes_Tiempo_de_estancia_en_Mexico',TRUE);    
        $data['semanas'] = $this->input->post('Semana_Tiempo_de_estancia_en_Mexico',TRUE);    
        $data['dias'] = $this->input->post('DiaTiempo_de_estancia_en_Mexico',TRUE);    
        $data['Motivos_para_permanecer_en_Mexico'] = $this->input->post('Motivos_para_permanecer_en_Mexico',TRUE);    
        $data['Con_que_documento_legal_de_estancia_cuenta'] = $this->input->post('Con_que_documento_legal_de_estancia_cuenta',TRUE);    
        $data['Tiene_algun_vinculo_con_una_persona_mexicana'] = $this->input->post('Tiene_algun_vinculo_con_una_persona_mexicana',TRUE);    

        $data['recibio_negativa'] = $this->input->post('Si_tiene_documento_de_legal_estancia_antes_de_obtenerlo_recibio_alguna_negativa_por_parte_del_Instituto_Nacional_de_Migracion_para_ello',TRUE);    
        $data['Descripcion_de_obstaculos_al_solicitar_su_legal_estancia'] = $this->input->post('Descripcion_de_obstaculos_al_solicitar_su_legal_estancia',TRUE);    
        $data['Una_vez_que_obtuvo_su_documento_de_legal_estancia_sufrio_algun_t'] = $this->input->post('Una_vez_que_obtuvo_su_documento_de_legal_estancia_sufrio_algun_tipo_de_abuso_por_parte_de_alguna_autoridad_o_prestador_de_servicios',TRUE);    
        $data['Acciones_que_llevo_a_cabo'] = $this->input->post('Acciones_que_llevo_a_cabo',TRUE);    
        $data['Ante_que_instancia'] = $this->input->post('Ante_que_instancia',TRUE);    
        // Verifica si existe registro con clave unica en folio y fecha
        try {
            $this->db->where('folio', $data['folio']);
            $query_existe = $this->db->get('form_ocho');
            if($query_existe->num_rows() > 0) {
                $this->db->where('folio', $data['folio']);
                $this->db->update('form_ocho', $data); 
            }else{
                $this->db->insert('form_ocho', $data); 
            }
            return TRUE;
        } catch (Exception $e) {
            return FALSE;
        }
    } // Fin Guarda Cuatro



    public function get_cadena($valor){
        $cadena = "";
        for ($i=0;$i<count($valor);$i++) {  
            if($valor[$i] == '--' OR $valor[$i] == "") continue;
             $cadena .=   $valor[$i] . ",";    
        } 
        return $cadena;
    }

    public function guarda_respuestas(){
    	$strId = $this->session->userdata('id');
    	$fecha = date('Y-m-d');
		$data = array();
		$limit = 1;
		$formulario = $this->input->post('formulario');
		$banderaLugar = FALSE;
		$orden_formulario = $this->input->post('orden_formulario');
		$folio = $this->input->post('folio');

		$cont = 1;
		foreach ($this->input->post() as $campo => $val) {
			if(trim($val) == "") continue;
			if($campo == 'submit') continue;
			if($campo == 'formulario' OR $campo == 'siguiente') continue;
			if($campo == "orden_formulario") continue;
			if($campo == "folio") continue;

			
			if($campo == 'Lugar_de_aplicacion' && $val != 'México'){
				$banderaLugar = TRUE;
			}

			if($banderaLugar == TRUE){
				if($campo == 'estado' OR $campo == 'ciudad') continue;
			}

			$data['idusuario'] = $strId;
			$data['pregunta'] = $campo;
			$data['resultado'] = $val;
			$data['fecha'] = $fecha;
			$data['formulario'] = $formulario;
			$data['orden'] = $cont;
			$data['orden_form'] = $orden_formulario;
			$data['folio'] = $folio;
		
			$this->db->where('idusuario', $strId);
			$this->db->where('pregunta', $campo);
			$query_1 = $this->db->get('resultados');

			if($query_1->num_rows() == 1) {
				$this->db->where('idusuario', $strId);
				$this->db->where('pregunta', $campo);
				$this->db->update('resultados', $data); 
			}else{
				$this->db->insert('resultados', $data); 
			}
			$cont ++;
		} // End For

		return TRUE;
    }

    public function get_respuestas(){
    	$strId = $this->session->userdata('id');
    	$query = $this->db->get_where('resultados', array('idusuario' => $strId));

    	if($query->num_rows() > 0 ){
    		return $query;
    	}else{
    		return FALSE;
    	}

    }

    public function get_respuestas_by_form(){
    	$strId = $this->session->userdata('id');
    	$cuestionario = $this->input->post('formulario');
    	$this->db->order_by("orden" , "asc");
    	$query = $this->db->get_where('resultados', array('idusuario' => $strId , 'formulario' =>$cuestionario));

    	if($query->num_rows() > 0 ){
    		return $query;
    	}else{
    		return FALSE;
    	}
    }

    public function get_respuetas_by_folio(){
    	$strId = $this->session->userdata('id');
    	$folio = $this->input->post('folio');

    	$this->db->order_by("orden_form" , "asc");
    	$this->db->order_by("orden" , "asc");
    	$query = $this->db->get_where('resultados', array('idusuario' => $strId , 'folio' =>$folio));

    	if($query->num_rows() > 0 ){
    		return $query;
    	}else{
    		return FALSE;
    	}
    }

    public function get_folios(){
    	$strId = $this->session->userdata('id');
    	$this->db->order_by("id" , "desc");
    	$query = $this->db->get_where('folios', array('idusuario' => $strId));

    	if($query->num_rows > 0 ){
    		return $query;
    	}else{
    		return FALSE;
    	}
    }


    public function get_nuevo_folio(){
    	$strId = $this->session->userdata('id');
    	$fecha = date('Y-m-d');

		$data = array(
			'idusuario' => $strId ,
			'fecha' => $fecha
		);

		$this->db->insert('folios', $data); 


		$this->db->select_max('id');
		$query = $this->db->get('folios');
		$query = $query->row();

		$mFolio = $query->id;
		return $mFolio;
    }


} // End Model forms