// Admin Dashboard Enhancements - MCQS Maker
document.addEventListener('DOMContentLoaded', function () {
  const deleteLinks = document.querySelectorAll('a[href*="delete"]');
  deleteLinks.forEach(link => {
    link.addEventListener('click', function (e) {
      if (!confirm('Are you sure you want to delete this item?')) {
        e.preventDefault();
      }
    });
  });
});
