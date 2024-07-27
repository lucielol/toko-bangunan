import "../style/Category.css";

const Category = () => {
    const categories = [
        { name: "Alat dan Bahan Bangunan", description: "Berbagai macam alat dan bahan bangunan berkualitas." },
        { name: "Alat Listrik", description: "Peralatan listrik untuk kebutuhan rumah dan industri." }
      ];
      
      function Category() {
        return (
          <div className="category-container">
            <h1 className="category-title">Kategori</h1>
            <div className="category-list">
              {categories.map((category, index) => (
                <div key={index} className="category-item">
                  <h2 className="category-name">{category.name}</h2>
                  <p className="category-description">{category.description}</p>
                </div>
              ))}
            </div>
          </div>
        );
      }
}

export default Category;