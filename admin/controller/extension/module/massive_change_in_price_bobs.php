<?php/** * Class ControllerExtensionModuleMassiveChangeInPricerBobs * @author  Bobs */class ControllerExtensionModuleMassiveChangeInPriceBobs extends Controller{    private $info = array();    public function install()    {        $this->load->model('setting/setting');        $this->load->model('user/user_group');        $this->load->model('design/layout');        $this->model_user_user_group->addPermission(            $this->user->getGroupId(),            'access',            'extension/module/massive_change_in_price_bobs'        );        $this->model_user_user_group->addPermission(            $this->user->getGroupId(),            'modify',            'extension/module/massive_change_in_price_bobs'        );        $faq_layout = array(            'name'         => 'The massive price change of Mr. Bobs',            'layout_route' => array(                'first_route' => array(                    'store_id' => '0',                    'route'    => 'massive_change_in_price_bobs'                )            )        );        $this->model_design_layout->addLayout($faq_layout);    }    public function uninstall()    {        $this->load->model('setting/setting');        $this->load->model('user/user_group');        $this->load->model('design/layout');        $this->model_user_user_group->removePermission(            $this->user->getGroupId(),            'access',            'extension/module/massive_change_in_price_bobs'        );        $this->model_user_user_group->removePermission(            $this->user->getGroupId(),            'modify',            'extension/module/massive_change_in_price_bobs'        );    }    public function index()    {        $this->getList();    }    protected function getList()    {        $this->load->language('catalog/product');        $this->load->language('extension/module/massive_change_in_price_bobs');        $this->document->setTitle($this->language->get('heading_title'));        $this->load->model('tool/image');        $this->load->model('catalog/product');        $this->load->model('catalog/category');        $this->load->model('extension/massive_change_in_price_bobs');        if (isset($this->request->get['filter_name'])) {            $filter_name = $this->request->get['filter_name'];        } else {            $filter_name = null;        }        if (isset($this->request->get['filter_model'])) {            $filter_model = $this->request->get['filter_model'];        } else {            $filter_model = null;        }        if (isset($this->request->get['filter_price'])) {            $filter_price = $this->request->get['filter_price'];        } else {            $filter_price = null;        }        if (isset($this->request->get['filter_quantity'])) {            $filter_quantity = $this->request->get['filter_quantity'];        } else {            $filter_quantity = null;        }        if (isset($this->request->get['filter_category'])) {            $filter_category = $this->request->get['filter_category'];        } else {            $filter_category = null;        }        if (isset($this->request->get['filter_status'])) {            $filter_status = $this->request->get['filter_status'];        } else {            $filter_status = null;        }        if (isset($this->request->get['filter_image'])) {            $filter_image = $this->request->get['filter_image'];        } else {            $filter_image = null;        }        if (isset($this->request->get['sort'])) {            $sort = $this->request->get['sort'];        } else {            $sort = 'pd.name';        }        if (isset($this->request->get['order'])) {            $order = $this->request->get['order'];        } else {            $order = 'ASC';        }        if (isset($this->request->get['page'])) {            $page = $this->request->get['page'];        } else {            $page = 1;        }        $url = '';        if (isset($this->request->get['filter_name'])) {            $url .= '&filter_name=' . urlencode(html_entity_decode(                    $this->request->get['filter_name'],                    ENT_QUOTES,                    'UTF-8'                    ));        }        if (isset($this->request->get['filter_category'])) {            $url .= '&filter_category=' . urlencode(html_entity_decode(                    $this->request->get['filter_category'],                    ENT_QUOTES,                    'UTF-8'                ));        }        if (isset($this->request->get['filter_model'])) {            $url .= '&filter_model=' . urlencode(html_entity_decode(                    $this->request->get['filter_model'],                    ENT_QUOTES,                    'UTF-8'                ));        }        if (isset($this->request->get['filter_price'])) {            $url .= '&filter_price=' . $this->request->get['filter_price'];        }        if (isset($this->request->get['filter_quantity'])) {            $url .= '&filter_quantity=' . $this->request->get['filter_quantity'];        }        if (isset($this->request->get['filter_status'])) {            $url .= '&filter_status=' . $this->request->get['filter_status'];        }        if (isset($this->request->get['filter_image'])) {            $url .= '&filter_image=' . $this->request->get['filter_image'];        }        if (isset($this->request->get['sort'])) {            $url .= '&sort=' . $this->request->get['sort'];        }        if (isset($this->request->get['order'])) {            $url .= '&order=' . $this->request->get['order'];        }        if (isset($this->request->get['page'])) {            $url .= '&page=' . $this->request->get['page'];        }        $data['breadcrumbs'] = array();        $data['breadcrumbs'][] = array(            'text' => $this->language->get('text_home'),            'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)        );        $data['breadcrumbs'][] = array(            'text' => $this->language->get('heading_title'),            'href' => $this->url->link('extension/module/massive_change_in_price_bobs',            'token=' . $this->session->data['token'] . $url, true)        );        $data['saveAll'] = $this->url->link(            'extension/module/massive_change_in_price_bobs/saveAll' . $url,            'token=' . $this->session->data['token'],            true        );        $data['basePrice'] = $this->url->link(            'extension/module/massive_change_in_price_bobs/basePrice',            'token=' . $this->session->data['token'] . $url,            true        );        $data['baseQuantity'] = $this->url->link(            'extension/module/massive_change_in_price_bobs/baseQuantity',            'token=' . $this->session->data['token'] . $url,            true        );        $data['cancel'] = $this->url->link(            'extension/extension',            'token=' . $this->session->data['token'] . '&type=module',            true        );        $data['products'] = array();        $filter_data = array(            'filter_name'     => $filter_name,            'filter_model'    => $filter_model,            'filter_price'    => $filter_price,            'filter_quantity' => $filter_quantity,            'filter_category' => $filter_category,            'filter_status'   => $filter_status,            'filter_image'    => $filter_image,            'sort'            => $sort,            'order'           => $order,            'start'           => ($page - 1) * $this->config->get('config_limit_admin'),            'limit'           => $this->config->get('config_limit_admin')        );        $product_total = $this->model_catalog_product->getTotalProducts($filter_data);        $results = $this->model_catalog_product->getProducts($filter_data);        $filter_data = array(            'sort'  => 'name',            'order' => 'ASC'        );        $data['categories'] = $this->model_catalog_category->getCategories($filter_data);        foreach ($results as $result) {            $category = $this->model_catalog_product->getProductCategories($result['product_id']);            if (is_file(DIR_IMAGE . $result['image'])) {                $image = $this->model_tool_image->resize($result['image'], 40, 40);            } else {                $image = $this->model_tool_image->resize('no_image.png', 40, 40);            }            $special = Array();            $product_specials = $this->model_catalog_product->getProductSpecials($result['product_id']);            foreach ($product_specials as $product_special) {                if (($product_special['date_start'] == '0000-00-00' || strtotime($product_special['date_start']) < time()) &&                    ($product_special['date_end'] == '0000-00-00' || strtotime($product_special['date_end']) > time())                    ) {                    $special['price'] = $product_special['price'];                    $special['product_special_id'] = $product_special['product_special_id'];                    break;                }            }            $discounts = $this->model_extension_massive_change_in_price_bobs->getProductDiscount($result['product_id']);            $data['products'][] = array(                'product_id' => $result['product_id'],                'image'      => $image,                'name'       => $result['name'],                'model'      => $result['model'],                'price'      => $result['price'],                'category'   => $category,                'discount'    => $discounts,                'special'    => $special,                'quantity'   => $result['quantity'],                'status'     => $result['status'],                'save'       => $this->url->link('extension/module/massive_change_in_price_bobs/save',                    'token=' . $this->session->data['token'] . '&product_id=' . $result['product_id'] . $url, true),                'edit'       => $this->url->link('catalog/product/edit',                    'token=' . $this->session->data['token'] . '&product_id=' . $result['product_id'] . $url, true)            );        }        $data['heading_title'] = $this->language->get('heading_title');        $data['text_list'] = $this->language->get('text_list');        $data['text_enabled'] = $this->language->get('text_enabled');        $data['text_disabled'] = $this->language->get('text_disabled');        $data['text_no_results'] = $this->language->get('text_no_results');        $data['text_confirm'] = $this->language->get('text_confirm');        $data['column_image'] = $this->language->get('column_image');        $data['column_name'] = $this->language->get('column_name');        $data['column_category'] = $this->language->get('column_category');        $data['column_discount'] = $this->language->get('column_discount');        $data['column_options'] = $this->language->get('column_options');        $data['column_model'] = $this->language->get('column_model');        $data['column_price'] = $this->language->get('column_price');        $data['column_quantity'] = $this->language->get('column_quantity');        $data['column_status'] = $this->language->get('column_status');        $data['column_action'] = $this->language->get('column_action');        $data['entry_name'] = $this->language->get('entry_name');        $data['entry_model'] = $this->language->get('entry_model');        $data['entry_price'] = $this->language->get('entry_price');        $data['entry_quantity'] = $this->language->get('entry_quantity');        $data['entry_status'] = $this->language->get('entry_status');        $data['entry_image'] = $this->language->get('entry_image');        $data['button_copy'] = $this->language->get('button_copy');        $data['button_add'] = $this->language->get('button_add');        $data['button_edit'] = $this->language->get('button_edit');        $data['button_delete'] = $this->language->get('button_delete');        $data['button_filter'] = $this->language->get('button_filter');        $data['entry_price'] = $this->language->get('entry_price'); //insert new        $data['old_product_text'] = $this->language->get('old_product_text'); //insert new        $data['old_product_special_text'] = $this->language->get('old_product_special_text'); //insert new        $data['old_quantity_text'] = $this->language->get('old_quantity_text'); //insert new        $data['old_status_text'] = $this->language->get('old_status_text'); //insert new        $data['product_special_text'] = $this->language->get('product_special_text'); //insert new        $data['discount_text_quantity'] = $this->language->get('discount_text_quantity'); //insert new        $data['discount_text_price'] = $this->language->get('discount_text_price'); //insert new        $data['entry_save'] = $this->language->get('entry_save'); //insert new        $data['entry_edit_product'] = $this->language->get('entry_edit_product'); //insert new        $data['entry_options_button'] = $this->language->get('entry_options_button'); //insert new        $data['entry_discount_button'] = $this->language->get('entry_discount_button'); //insert new        $data['entry_delete_special'] = $this->language->get('entry_delete_special'); //insert new        $data['entry_delete_discount'] = $this->language->get('entry_delete_discount'); //insert new        $data['attentions_no_discount'] = $this->language->get('attentions_no_discount'); //insert new        $data['attentions_no_options'] = $this->language->get('attentions_no_options'); //insert new        $data['attentions_no_options_price'] = $this->language->get('attentions_no_options_price'); //insert new        $data['button_save'] = $this->language->get('button_save');        $data['button_cancel'] = $this->language->get('button_cancel');        $data['help_base_price'] = $this->language->get('help_base_price');        $data['help_base_price_button'] = $this->language->get('help_base_price_button');        $data['help_base_quantity'] = $this->language->get('help_base_quantity');        $data['help_base_quantity_button'] = $this->language->get('help_base_quantity_button');        $data['text_confirm_quest'] = $this->language->get('text_confirm_quest');        if (isset($this->request->post['base_price_factor_prefix'])) {            $data['base_price_factor_prefix'] = $this->request->post['base_price_factor_prefix'];        } else {            $data['base_price_factor_prefix'] = "+";        }        if (isset($this->request->post['base_price_factor'])) {            $data['base_price_factor'] = $this->request->post['base_price_factor'];        } else {            $data['base_price_factor'] = "";        }        if (isset($this->request->post['base_quantity_factor_prefix'])) {            $data['base_quantity_factor_prefix'] = $this->request->post['base_quantity_factor_prefix'];        } else {            $data['base_quantity_factor_prefix'] = "+";        }        if (isset($this->request->post['base_quantity_factor'])) {            $data['base_quantity_factor'] = $this->request->post['base_quantity_factor'];        } else {            $data['base_quantity_factor'] = "";        }        $data['token'] = $this->session->data['token'];        if (isset($this->session->data['success'])) {            $data['success'] = $this->session->data['success'];            unset($this->session->data['success']);        } else {            $data['success'] = '';        }        if (!empty($this->info)) {            $data['info'] = $this->info[0];        } else {            $data['info'] = '';        }        if (isset($this->request->post['selected'])) {            $data['selected'] = (array)$this->request->post['selected'];        } else {            $data['selected'] = array();        }        $url = '';        if (isset($this->request->get['filter_name'])) {            $url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES,                        'UTF-8'));        }        if (isset($this->request->get['filter_model'])) {            $url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES,                        'UTF-8'));        }        if (isset($this->request->get['filter_price'])) {            $url .= '&filter_price=' . $this->request->get['filter_price'];        }        if (isset($this->request->get['filter_quantity'])) {            $url .= '&filter_quantity=' . $this->request->get['filter_quantity'];        }        if (isset($this->request->get['filter_category'])) {            $url .= '&filter_category=' . $this->request->get['filter_category'];        }        if (isset($this->request->get['filter_status'])) {            $url .= '&filter_status=' . $this->request->get['filter_status'];        }        if (isset($this->request->get['filter_image'])) {            $url .= '&filter_image=' . $this->request->get['filter_image'];        }        if ($order == 'ASC') {            $url .= '&order=DESC';        } else {            $url .= '&order=ASC';        }        if (isset($this->request->get['page'])) {            $url .= '&page=' . $this->request->get['page'];        }        $data['sort_name'] = $this->url->link('extension/module/massive_change_in_price_bobs',            'token=' . $this->session->data['token'] . '&sort=pd.name' . $url, true);        $data['sort_model'] = $this->url->link('extension/module/massive_change_in_price_bobs',            'token=' . $this->session->data['token'] . '&sort=p.model' . $url, true);        $data['sort_price'] = $this->url->link('extension/module/massive_change_in_price_bobs',            'token=' . $this->session->data['token'] . '&sort=p.price' . $url, true);        $data['sort_quantity'] = $this->url->link('extension/module/massive_change_in_price_bobs',            'token=' . $this->session->data['token'] . '&sort=p.quantity' . $url, true);        $data['sort_status'] = $this->url->link('extension/module/massive_change_in_price_bobs',            'token=' . $this->session->data['token'] . '&sort=p.status' . $url, true);        $data['sort_order'] = $this->url->link('extension/module/massive_change_in_price_bobs',            'token=' . $this->session->data['token'] . '&sort=p.sort_order' . $url, true);        $url = '';        if (isset($this->request->get['filter_name'])) {            $url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES,                        'UTF-8'));        }        if (isset($this->request->get['filter_model'])) {            $url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES,                        'UTF-8'));        }        if (isset($this->request->get['filter_price'])) {            $url .= '&filter_price=' . $this->request->get['filter_price'];        }        if (isset($this->request->get['filter_quantity'])) {            $url .= '&filter_quantity=' . $this->request->get['filter_quantity'];        }        if (isset($this->request->get['filter_category'])) {            $url .= '&filter_category=' . $this->request->get['filter_category'];        }        if (isset($this->request->get['filter_status'])) {            $url .= '&filter_status=' . $this->request->get['filter_status'];        }        if (isset($this->request->get['filter_image'])) {            $url .= '&filter_image=' . $this->request->get['filter_image'];        }        if (isset($this->request->get['sort'])) {            $url .= '&sort=' . $this->request->get['sort'];        }        if (isset($this->request->get['order'])) {            $url .= '&order=' . $this->request->get['order'];        }        $pagination = new Pagination();        $pagination->total = $product_total;        $pagination->page = $page;        $pagination->limit = $this->config->get('config_limit_admin');        $pagination->url = $this->url->link('extension/module/massive_change_in_price_bobs',            'token=' . $this->session->data['token'] . $url . '&page={page}', true);        $data['pagination'] = $pagination->render();        $limit_page = $this->config->get('config_limit_admin');        $data['results'] = sprintf($this->language->get('text_pagination'),            ($product_total) ? (($page - 1) * $limit_page) + 1 : 0,            ((($page - 1) * $limit_page) > ($product_total - $limit_page)) ? $product_total : ((($page - 1) * $limit_page) + $limit_page),            $product_total, ceil($product_total / $limit_page));        $data['filter_name'] = $filter_name;        $data['filter_model'] = $filter_model;        $data['filter_price'] = $filter_price;        $data['filter_quantity'] = $filter_quantity;        $data['filter_category'] = $filter_category;        $data['filter_status'] = $filter_status;        $data['filter_image'] = $filter_image;        $data['sort'] = $sort;        $data['order'] = $order;        $data['header'] = $this->load->controller('common/header');        $data['column_left'] = $this->load->controller('common/column_left');        $data['footer'] = $this->load->controller('common/footer');        $this->response->setOutput($this->load->view('extension/module/massive_change_in_price_bobs_list', $data));    }    public function autoComplete()    {        $json = array();        if (isset($this->request->get['filter_name']) || isset($this->request->get['filter_model'])) {            $this->load->model('catalog/product');            $this->load->model('catalog/option');            if (isset($this->request->get['filter_name'])) {                $filter_name = $this->request->get['filter_name'];            } else {                $filter_name = '';            }            if (isset($this->request->get['filter_model'])) {                $filter_model = $this->request->get['filter_model'];            } else {                $filter_model = '';            }            if (isset($this->request->get['limit'])) {                $limit = $this->request->get['limit'];            } else {                $limit = 5;            }            $filter_data = array(                'filter_name'  => $filter_name,                'filter_model' => $filter_model,                'start'        => 0,                'limit'        => $limit            );            $results = $this->model_catalog_product->getProducts($filter_data);            foreach ($results as $result) {                $option_data = array();                $product_options = $this->model_catalog_product->getProductOptions($result['product_id']);                foreach ($product_options as $product_option) {                    $option_info = $this->model_catalog_option->getOption($product_option['option_id']);                    if ($option_info) {                        $product_option_value_data = array();                        foreach ($product_option['product_option_value'] as $product_option_value) {                            $option_value_info = $this->model_catalog_option->getOptionValue($product_option_value['option_value_id']);                            if ($option_value_info) {                                $product_option_price = (float)$product_option_value['price'] ?                                    $this->currency->format($product_option_value['price'], $this->config->get('config_currency')) :                                    false;                                $product_option_value_data[] = array(                                    'product_option_value_id' => $product_option_value['product_option_value_id'],                                    'option_value_id'         => $product_option_value['option_value_id'],                                    'name'                    => $option_value_info['name'],                                    'price'                   => $product_option_price,                                    'price_prefix'            => $product_option_value['price_prefix']                                );                            }                        }                        $option_data[] = array(                            'product_option_id'    => $product_option['product_option_id'],                            'product_option_value' => $product_option_value_data,                            'option_id'            => $product_option['option_id'],                            'name'                 => $option_info['name'],                            'type'                 => $option_info['type'],                            'value'                => $product_option['value'],                            'required'             => $product_option['required']                        );                    }                }                $json[] = array(                    'product_id' => $result['product_id'],                    'name'       => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8')),                    'model'      => $result['model'],                    'option'     => $option_data,                    'price'      => $result['price']                );            }        }        $this->response->addHeader('Content-Type: application/json');        $this->response->setOutput(json_encode($json));    }    public function save()    {        $this->load->language('extension/module/massive_change_in_price_bobs');        $this->load->model('extension/massive_change_in_price_bobs');        $this->setValues($this->request->post);        $this->session->data['success'] = $this->language->get('success_update');        $this->response->addHeader('Content-Type: application/json');        $json = array();        $this->response->setOutput(json_encode($json));    }    public function saveAll()    {        $this->load->language('extension/module/massive_change_in_price_bobs');        $this->load->model('extension/massive_change_in_price_bobs');        $this->session->data['success'] = $this->language->get('success_update');        $this->setValues($this->request->post);        $this->getList();    }    private function setValues($post_parameters)    {        foreach ($post_parameters as $key => $value) {            $this->setValue('price_', $key, $value, 'setProductPrice');            $this->setValue('product_special_id_', $key, $value, 'setProductSpecialPrice');            $this->setValue('product_option_value_id_', $key, $value, 'setProductOptionPrice');            $this->setValue('product_discount_quantity_id_', $key, $value, 'setProductDiscountQuantity');            $this->setValue('product_discount_price_id_', $key, $value, 'setProductDiscountPrice');            $this->setValue('quantity_', $key, $value, 'setProductQuantity');            $this->setValue('status_', $key, $value, 'setProductStatus');        }    }    private function setValue($prefix, $key, $value, $name_function){        if (strpos($key, $prefix) !== false) {            $id = str_replace($prefix, '', $key);            $this->model_extension_massive_change_in_price_bobs->$name_function($id, $value);        }    }    /**     *  AJAX function     */    public function deleteSpecial()    {        $this->load->model('extension/massive_change_in_price_bobs');        $product_special_id = $this->request->get['product_special_id'];        $product_id = $this->model_extension_massive_change_in_price_bobs->getProductIdBySpecial($product_special_id);        $this->model_extension_massive_change_in_price_bobs->deleteSpecial($product_special_id);        $product_special = $this->model_extension_massive_change_in_price_bobs->getSpecialByProduct($product_id);        $this->response->addHeader('Content-Type: application/json');        $this->response->setOutput(json_encode($product_special));    }    /**     *  AJAX function     */    public function deleteDiscount()    {        $this->load->model('extension/massive_change_in_price_bobs');        $product_discount_id = $this->request->get['product_discount_id'];        $product_id = $this->model_extension_massive_change_in_price_bobs->getProductIdByDiscount($product_discount_id);        $this->model_extension_massive_change_in_price_bobs->deleteDiscount($product_discount_id);        $discounts = $this->model_extension_massive_change_in_price_bobs->getProductDiscount($product_id);        $this->response->addHeader('Content-Type: application/json');        $this->response->setOutput(json_encode($discounts));    }    /**     *  AJAX function     */    public function discount()    {        $this->load->model('extension/massive_change_in_price_bobs');        $product_id = $this->request->get['product_id'];        $discounts = $this->model_extension_massive_change_in_price_bobs->getProductDiscount($product_id);        $this->response->addHeader('Content-Type: application/json');        $this->response->setOutput(json_encode($discounts));    }    /**     *  AJAX function     */    public function options()    {        $this->load->language('extension/module/massive_change_in_price_bobs');        $this->load->model('catalog/product');        $product_id = $this->request->get['product_id'];        $options_value = $this->model_catalog_product->getProductOptions($product_id);        $options = array();        foreach ($options_value as $option_value) {            $option = array();            $option['name'] = $option_value['name'];            foreach ($option_value['product_option_value'] as $key => $product_option_value) {                $name_option = $this->model_catalog_product->getProductOptionValue($product_id,                    $product_option_value['product_option_value_id']);                $option['options'][$key]['name'] = $name_option['name'];                $option['options'][$key]['price_prefix'] = $product_option_value['price_prefix'];                $option['options'][$key]['price'] = $product_option_value['price'];                $option['options'][$key]['product_option_value_id'] = $product_option_value['product_option_value_id'];            }            $options[] = $option;        }        $this->response->addHeader('Content-Type: application/json');        $this->response->setOutput(json_encode($options));    }    public function basePrice()    {        $this->baseModifier('price');    }    public function baseQuantity()    {        $this->baseModifier('quantity');    }    private function baseModifier($name_modifier){        $this->load->language('extension/module/massive_change_in_price_bobs');        $this->load->model('extension/massive_change_in_price_bobs');        $products = $this->getProductByFilter();        if (!empty($this->request->post['base_' . $name_modifier . '_factor'])) {            $base_factor = $this->request->post['base_' . $name_modifier . '_factor'];            $base_factor_prefix = $this->request->post['base_'. $name_modifier . '_factor_prefix'];            foreach ($products as $key => $product) {                $product_id = $product['product_id'];                $name_function = 'setProduct'. ucfirst($name_modifier);                $value_result = $this->getValueByPrefix($product[$name_modifier], $base_factor_prefix, $base_factor);                $this->model_extension_massive_change_in_price_bobs->$name_function($product_id, $value_result);            }            $this->info[] = $this->language->get('info_yes_base_' . $name_modifier . '_factor');        } else {            $this->info[] = $this->language->get('info_no_base_' . $name_modifier . '_factor');        }        $this->getList();    }    private function getProductByFilter()    {        $this->load->model('catalog/product');        $filter_data = array(            'filter_name'     => $this->filterArray('filter_name'),            'filter_model'    => $this->filterArray('filter_model'),            'filter_price'    => $this->filterArray('filter_price'),            'filter_quantity' => $this->filterArray('filter_quantity'),            'filter_category' => $this->filterArray('filter_category'),            'filter_status'   => $this->filterArray('filter_status'),            'filter_image'    => $this->filterArray('filter_image')        );        $results = $this->model_catalog_product->getProducts($filter_data);        return $results;    }    private function filterArray($filter_name)    {        if (isset($this->request->get[$filter_name])) {            return $this->request->get[$filter_name];        } else {            return null;        }    }    private function getValueByPrefix($value, $prefix, $coefficient)    {        $value_result = 1;        switch($prefix) {            case '+':                $value_result = $value + $coefficient;                break;            case '-':                $value_result = $value - $coefficient;                break;            case '*':                $value_result = $value * $coefficient;                break;            case '=':                $value_result = $coefficient;                break;        }        return $value_result;    }}?>