<?php
/**
* 
* Gallery Control test
*
* @copyright (c) 2014 Stanislav Atanasov
* @license GNU General Public License, version 2 (GPL-2.0)
* 
* Here we are going to test ACP
*
*/
namespace phpbbgallery\tests\functional;
/**
* @group functional
*/
class phpbbgallery_alpha_test extends phpbbgallery_base
{
	public function install_data()
	{
		return array(
			'core_verview'	=> array(
				'phpbbgallery/core',
				'gallery_acp',
				'adm/index.php?i=-phpbbgallery-core-acp-main_module&mode=overview',
				$this->user->lang('ACP_GALLERY_OVERVIEW_EXPLAIN')
			),
			'core_config'	=> array(
				'phpbbgallery/core',
				'gallery_acp',
				'adm/index.php?i=-phpbbgallery-core-acp-config_module&mode=main',
				$this->user->lang('GALLERY_CONFIG')
			),
			'core_albums'	=> array(
				'phpbbgallery/core',
				'gallery_acp',
				'adm/index.php?i=-phpbbgallery-core-acp-albums_module&mode=manage',
				$this->user->lang('ALBUM_ADMIN')
			),
			'core_perms'	=> array(
				'phpbbgallery/core',
				'gallery_acp',
				'adm/index.php?i=-phpbbgallery-core-acp-permissions_module&mode=manage',
				$this->user->lang('PERMISSIONS_EXPLAIN')
			),
			'core_copy_perms'	=> array(
				'phpbbgallery/core',
				'gallery_acp',
				'adm/index.php?i=-phpbbgallery-core-acp-permissions_module&mode=copy',
				$this->user->lang('PERMISSIONS_COPY')
			),
			'core_log'	=> array(
				'phpbbgallery/core',
				'info_acp_gallery_logs',
				'adm/index.php?i=-phpbbgallery-core-acp-gallery_logs_module&mode=main',
				$this->user->lang('LOG_GALLERY_SHOW_LOGS')
			),
			// This is core, now extensions
			'exif'	=> array(
				'phpbbgallery/exif',
				'exif',
				'adm/index.php?i=-phpbbgallery-core-acp-config_module&mode=main',
				$this->user->lang('DISP_EXIF_DATA')
			),
			'acp_cleanup'	=> array(
				'phpbbgallery/acpcleanup',
				'info_acp_gallery_cleanup',
				'adm/index.php?i=-phpbbgallery-acpcleanup-acp-main_module&mode=cleanup',
				$this->user->lang('ACP_GALLERY_CLEANUP')
			),
			'acp_import'	=> array(
				'phpbbgallery/acpimport',
				'info_acp_gallery_cleanup',
				'adm/index.php?i=-phpbbgallery-acpimport-acp-main_module&mode=import_images',
				$this->user->lang('ACP_IMPORT_ALBUMS')
			),
		);
	}
	/**
	* @dataProvider install_data
	*/
	public function test_install($ext, $lang, $path, $search)
	{
		$this->login();
		$this->admin_login();
		
		$this->add_lang_ext($ext, $lang);
		$crawler = self::request('GET', $path . '&sid=' . $this->sid);
		$this->assertContains($search, $crawler->text());
		
		$this->logout();
		$this->logout();
	}
}