<?php

class Studio extends Controller
{
    public function index()
    {
        if (!isset($_SESSION['pseudo'])) {
			header('Location: /index.php/login');
		}
        $this->loadModel('FilterModel');
        $this->loadModel('PostModel');

        $data['filters'] = $this->FilterModel->get_filters();
        $data['posts'] = $this->PostModel->get_user_posts($_SESSION['id']);

        $this->loadView('templates/header');
        $this->loadView('Studio/index', $data);
        $this->loadView('templates/footer');
    }

    public function save()
    {
        if (!empty($_POST['image'])) {
            $this->loadModel('StudioModel');
            $this->loadModel('FilterModel');
			$this->loadModel('PostModel');
			// Check le fichier uploadé en lisant son magic
            $type = mime_content_type($_POST['image']);
            if ($type == "image/png" || $type == "image/jpeg") {
				// Si pas de filtre sélectionné, on applique un filtre transparent
                if (!isset($_POST['filter'])) {
                    $_POST['filter'] = "assets/filters/transparent.png";
				}
				// On récupère le filtre correspondant
				$filter = $this->FilterModel->get_filter_by_id($_POST['filter']);
				// On superpose les deux images
                $img = preg_replace('/^data:image\/(png|jpeg);base64,/', "", $_POST['image']);
                $new_image = $this->StudioModel->save_img($img, $filter, $type);
                // On crée le post
				$this->PostModel->create_post($new_image, htmlspecialchars($_POST['caption']));
                header('Location: /index.php/Studio');
            } else {
                $this->loadView('templates/header');
                $this->loadView('studio/error');
                $this->loadView('templates/footer');
            }
		}
		else {
			header('Location: /index.php/Studio');
		}
    }

    public function error()
    {
        $this->loadView('templates/header');
        $this->loadView('studio/error');
        $this->loadView('templates/footer');
	}
}
