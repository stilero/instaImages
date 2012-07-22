  <?php
/**
* Imagepicker Model
*
* @version  1.0
* @author Daniel Eliasson - joomla at stilero.com
* @copyright  (C) 2012-maj-10 Stilero Webdesign http://www.stilero.com
* @category Models
* @license    GPLv2
*/
 
 defined('_JEXEC') or die('Restricted access');

 // Import the JModel class
jimport( 'joomla.application.component.model' );
 
class InstaimagesModelImagepicker  extends JModel { 

	
	protected $_access_token = null;
        protected $_client_id = null;
        protected $_client_secret = null;

/**
 * Constructor
 */
	
	public function __construct()
	{
		parent::__construct();
                $params = & JComponentHelper::getParams('com_instaimages');
                $this->_access_token = $params->get('access_token');
                $this->_client_id = $params->get('client_id');
                $this->_client_secret = $params->get('client_secret');
	}

	/**
	* Method to build the query
	*
	* @access private
	* @return string query	
	*/
        
	protected function _buildQuery()
	{
		return parent::_buildQuery();
	}
	
	/**
	 * Method to store the Item
	 *
	 * @access	public
	 * @return	boolean	True on success
	 */
	public function store($data)
	{
		$row =& $this->getTable();
		/**
		 * Example: get text from editor 
		 * $Text  = JRequest::getVar( 'text', '', 'post', 'string', JREQUEST_ALLOWRAW );
		 */
		 
		// Bind the form fields to the table
		if (!$row->bind($data)) {
			$this->setError($row->getError());
			return false;
		}

		// Make sure the table is valid
		if (!$row->check()) {
			$this->setError($row->getError());
			return false;
		}
		
		/**
		 * Clean text for xhtml transitional compliance
		 * $row->text		= str_replace( '<br>', '<br />', $Text );
		 */
	
		// Store the table to the database
		if (!$row->store()) {
			$this->setError($row->getError());
			return false;
		}
		$this->setId($row->{$row->getKeyName()});
		return $row->{$row->getKeyName()};
	}	

	/**
	* Method to build the Order Clause
	*
	* @access private
	* @return string orderby	
	*/
	
	protected function _buildContentOrderBy() 
	{
		$app = &JFactory::getApplication('');
		$context			= $this->option.'.'.strtolower($this->getName()).'.list.';
		$filter_order = $app ->getUserStateFromRequest($context . 'filter_order', 'filter_order', $this->getDefaultFilter(), 'cmd');
		$filter_order_Dir = $app ->getUserStateFromRequest($context . 'filter_order_Dir', 'filter_order_Dir', '', 'word');
		$this->_query->order($filter_order . ' ' . $filter_order_Dir );
	}
	
	/**
	* Method to build the Where Clause 
	*
	* @access private
	* @return string orderby	
	*/
	
	protected function _buildContentWhere() 
	{
		
		$app = &JFactory::getApplication('');
		$context			= $this->option.'.'.strtolower($this->getName()).'.list.';		
		$filter_state = $app ->getUserStateFromRequest($context . 'filter_state', 'filter_state', '', 'word');		
		$filter_order = $app ->getUserStateFromRequest($context . 'filter_order', 'filter_order', $this->getDefaultFilter(), 'cmd');
		$filter_order_Dir = $app ->getUserStateFromRequest($context . 'filter_order_Dir', 'filter_order_Dir', 'desc', 'word');
		$search = $app ->getUserStateFromRequest($context . 'search', 'search', '', 'string');
					
		if ($search) {
			$this->_query->where('LOWER(a.name) LIKE ' . $this->_db->Quote('%' . $search . '%'));			
		}		
		if ($filter_state) {
			if ($filter_state == 'P') {
				$this->_query->where("a.published = 1");
			} elseif ($filter_state == 'U') {
					$this->_query->where("a.published = 0");
			} else {
				$this->_query->where("a.published > -2");
			}
		}		
	}
        
        public function getUserImages(){
            $displayType = 'user-recent';
            $userID = 'self';
            $imageCount = 30;
            $clientID = $this->_client_id;
            $clientSecret = $this->_client_secret;
            $accessToken = $this->_access_token;
            $config = array();
            require_once JPATH_COMPONENT_ADMINISTRATOR.DS.'lib'.DS.'instaClass.php';
            $Instagram = new instaClass($clientId, $clientSecret, '', $accessToken, $config);
            $images = $Instagram->fetchImages($userID, $imageCount, $displayType, $postParams);
            return $images;
        }
	
}
?>