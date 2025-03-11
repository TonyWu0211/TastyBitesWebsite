<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Event\EventInterface;
use Cake\Datasource\EntityInterface;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;


/**
 * Product Model
 *
 * @property \App\Model\Table\OrdersTable&\Cake\ORM\Association\HasMany $Orders
 *
 * @method \App\Model\Entity\Product newEmptyEntity()
 * @method \App\Model\Entity\Product newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Product> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Product get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Product findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Product patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Product> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Product|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Product saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Product>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Product>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Product>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Product> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Product>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Product>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Product>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Product> deleteManyOrFail(iterable $entities, array $options = [])
 */
class ProductTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('product');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('Orders', [
            'foreignKey' => 'product_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('name')
            ->maxLength('name', 60)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->integer('price')
            ->requirePresence('price', 'create')
            ->notEmptyString('price');

        $validator
            ->scalar('availability')
            ->maxLength('availability', 60)
            ->requirePresence('availability', 'create')
            ->notEmptyString('availability');

        $validator
            ->scalar('dietary_type')
            ->maxLength('dietary_type', 60)
            ->requirePresence('dietary_type', 'create')
            ->notEmptyString('dietary_type');

        $validator
            ->allowEmptyFile('image_path')
            ->add('image_path', 'file', [
                'rule' => ['mimeType', ['image/jpeg', 'image/png']],
                'message' => 'Please upload valid image files (jpg, jpeg, png).',
                'on' => function ($context) {
                    return isset($context['data']['image_path']) &&
                        $context['data']['image_path'] instanceof \Psr\Http\Message\UploadedFileInterface &&
                        $context['data']['image_path']->getError() !== UPLOAD_ERR_NO_FILE;
                }
            ])
            ->add('image_path', 'fileSize', [
                'rule' => ['fileSize', '<=', '2MB'],
                'message' => 'Image file size must be less than 2MB.',
                'on' => function ($context) {
                    return isset($context['data']['image_path']) &&
                        $context['data']['image_path'] instanceof \Psr\Http\Message\UploadedFileInterface &&
                        $context['data']['image_path']->getError() !== UPLOAD_ERR_NO_FILE;
                }
            ]);

        return $validator;
    }

   public function beforeSave(EventInterface $event, EntityInterface $entity, \ArrayObject $options)
    {
        if ($entity->image_path instanceof \Laminas\Diactoros\UploadedFile) {
            $file = $entity->image_path;
            $filePath = WWW_ROOT . 'img' . DS . 'product_images' . $file->getClientFilename();
            $file->moveTo($filePath);
            $entity->image_path = $filePath;
        }
    }
}
