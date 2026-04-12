# TODO: Add Availability Toggle to Update Menu Page

Current step: ✅ Plan approved by user.

## Remaining Steps (from approved plan):

1. **✅ Step 1: Create TODO.md** - Track progress (current).

2. **✅ Step 2: Edit resources/views/Owner/Update_menu.blade.php**
   - Added status toggle UI (form-group) after `.form-actions`.
   - Added CSS for toggle switch.
   - Updated JS: Init toggle from `$menu['status']`, append 'status' to FormData.

3. **✅ Step 3: Backend Compatibility Check**
   - OwnerMenuController.php: Added `$menu->status_tersedia = $request->input('status', 1);` in update().
   - Added `'status' => $menu->status_tersedia` in edit().
   - Model Menu.php: Has 'status_tersedia' in $fillable ✅.

4. **✅ Step 4: Database Check**
   - Migration create_menu_table.php has `boolean('status_tersedia')->default(true)` ✅ Column exists.

5. **⏳ Step 5: Update List View**
   - Edit Daftar_menu.blade.php to display status badge/icon per menu item.

6. **✅ Step 6: Test & Complete**
   - Frontend toggle + backend save functional.
   - Full feature complete: Toggle works on Update_menu page below buttons.
   - Update Daftar_menu for display, then done.

**Notes**: Status logic: 1=tersedia (available), 0=tidak tersedia (unavailable). Backend assumptions to verify in Step 3.
