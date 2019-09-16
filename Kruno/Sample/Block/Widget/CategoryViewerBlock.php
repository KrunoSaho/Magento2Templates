<?php
declare(strict_types=1);

namespace Kruno\Sample\Block\Widget;


class CategoryViewerBlock extends \Magento\Framework\View\Element\Template 
    implements \Magento\Widget\Block\BlockInterface
{
    protected $_template = "widgets/completeCategoryViewer.phtml";

    /**
     * @var \Kruno\Sample\Model\CategoryViewer
    */
    protected $_categoryViewer;

    /**
     * @var \Magento\Framework\Json\EncoderInterface
    */
    protected $_jsonEncoder;


    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\Json\EncoderInterface $jsonEncoder,
        \Kruno\Sample\Api\CategoryViewerInterface $categoryViewer,
        array $data=[]
    )
    {
        parent::__construct($context, $data);
        $this->_categoryViewer = $categoryViewer;
        $this->jsonEncoder = $jsonEncoder;
    }

    

    private function attach($node, &$data, $paths, $pathNames)
    {
        if (empty($paths)) {
            return;
        }
        if (\count($paths) == 1 && $node['children_count'] == 0) {
            $data[] = $node['name'];
            \asort($data);
            return;
        }
        
        $pathName = $pathNames[array_shift($paths)];
        if (\array_key_exists($pathName, $data) === false) {
            $data[$pathName] = [];
        }

        $this->attach($node, $data[$pathName], $paths, $pathNames);
    }



    public function getCategories(): string 
    {
        $nodes = $this->_categoryViewer->getCompleteCategoryList();
        $pathNames = [];
        $data = [];

        // precompile mapping names
        foreach ($nodes as $node) {
            $pathNames[$node['entity_id']] = $node['name'];
        }

        foreach ($nodes as $node) {
            $path = \explode('/', $node['path']);
            $this->attach($node, $data, $path, $pathNames);
        }

        // return $this->jsonEncoder->encode($data);
        // ugly hack
        return \json_encode($data, JSON_PRETTY_PRINT);
    }

}
